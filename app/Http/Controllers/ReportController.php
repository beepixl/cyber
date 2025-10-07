<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\User;
use App\Models\Cdr;
use App\Models\Ipdr;
use App\Models\MuleAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function view(Request $request)
    {

        if (auth()->user()->user_type === 'admin') {
            $userId = $request->user;
        } else {
            if ($request->user == auth()->id()) {
                $userId = auth()->id();
            } else {
                return redirect()->back()->with('error', 'You are not authorized to view this report');
            }
        }

       

        $from = $request->from;
        $to = $request->to;
        $endDate = $request->endDate;
        $reports = $request->reports;

        $user = User::find($userId);
        $startDate = $from ? Carbon::parse($from) : Carbon::now()->startOfMonth();
        $endDate = $to ? Carbon::parse($to) : Carbon::now()->endOfMonth();
        $month = $startDate;

        $reports = DailyReport::query()
            ->when($userId, fn ($query) => $query->where('user_id', $userId))
            ->when($from, fn ($query) => $query->whereDate('date', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('date', '<=', $to))
            ->orderBy('date')
            ->get();

        return view('reports.view', compact('user', 'month', 'startDate', 'endDate', 'reports'));
    }

    public function showTransactionTree($acknowledgementNo)
    {
        $transactions = DB::table('bank_transactions')
            ->where('acknowledgement_no', $acknowledgementNo)
            ->get();

        $allTransactions = collect();

        foreach ($transactions as $txn) {
            $txn->account_id = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $txn->account_id ?? ''));
            $txn->to_account_id = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $txn->to_account_id ?? ''));
            $allTransactions->push($txn);
        }

        // Map account_id => list of transactions where this account_id is "from"
        $txnMap = [];
        foreach ($allTransactions as $txn) {
            $txnMap[$txn->account_id][] = $txn;
        }

        // Recursive function to build chains
        $buildChains = function ($txn, $txnMap, $depth = 1) use (&$buildChains) {
            $currentLayer = [
                'layer' => $depth,
                'from' => $txn->account_id,
                'to' => $txn->to_account_id,
                'amount' => $txn->transaction_amount,
                'bank_name' => $txn->bank_name,
                'ifsc' => $txn->ifsc_code,
                'remarks' => $txn->remarks,
            ];

            $nextTxns = $txnMap[$txn->to_account_id] ?? [];

            if (empty($nextTxns)) {
                // Terminal node, return one chain with this single layer
                return [[$currentLayer]];
            }

            $chains = [];
            foreach ($nextTxns as $nextTxn) {
                $subChains = $buildChains($nextTxn, $txnMap, $depth + 1);
                foreach ($subChains as $chain) {
                    // Prepend current layer
                    array_unshift($chain, $currentLayer);
                    $chains[] = $chain;
                }
            }

            return $chains;
        };

        // Find root accounts = those that appear as "from" but never as "to"
        $fromAccounts = $allTransactions->pluck('account_id')->unique();
        $toAccounts = $allTransactions->pluck('to_account_id')->unique();
        $rootAccounts = $fromAccounts->diff($toAccounts);

        // If no roots found, fallback to all unique from accounts (to avoid empty results)
        if ($rootAccounts->isEmpty()) {
            $rootAccounts = $fromAccounts;
        }

        $allChains = [];

        // For **each root account**, find all transactions that start from that account and build chains from each
        foreach ($rootAccounts as $rootAccount) {
            if (! isset($txnMap[$rootAccount])) {
                continue;
            }

            foreach ($txnMap[$rootAccount] as $rootTxn) {
                $chainsFromTxn = $buildChains($rootTxn, $txnMap);
                $allChains = array_merge($allChains, $chainsFromTxn);
            }
        }

        return view('bank.transactions.tree', ['chains' => $allChains]);
    }

    public function printMuleAccountPdf($record)
    {
        
        $muleAccount1 = MuleAccount::where('id', $record)->first();

        $muleAccount = MuleAccount::where('outward_no', $muleAccount1->outward_no)->get();
      
        return view('print-mule-account', compact('muleAccount'));
    }

    public function printCdrPdf($record)
    {
        $cdr = Cdr::where('id', $record)->first();
        return view('print-cdr', compact('cdr'));
    }


    public function printIPDRpdf($record)
    {
        $ipdr = Ipdr::where('id', $record)->first();
        return view('print-ipdr', compact('ipdr'));
    }
}
