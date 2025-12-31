<?php

namespace App\Filament\Resources\CyberCaseResource\Pages;

use App\Filament\Resources\CyberCaseResource;
use App\Models\BankTransaction;
use Dompdf\Dompdf;
use Dompdf\Options;
use Filament\Resources\Pages\Page;

class PrintBankTransaction extends Page
{
    protected static string $resource = CyberCaseResource::class;

    protected static string $view = 'print-bank-pdf';

    public function generatePdf($record = null)
    {
        $options = new Options;
        $options->set('isHtml5ParserEnabled', true);

        $options->set('isRemoteEnabled', true);
        $options->set('tempDir', '/tmp');
        $options->set('chroot', __DIR__);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        $case = BankTransaction::with('case')->findOrFail($record);
        
        $relatedBankTransactions = BankTransaction::where('outward_no', $case->outward_no)->get();

        


        if ($case->info_type == 'Instagram') {
            $html = view('print-instagram-pdf', [
                'case' => $case, 
                'relatedBankTransactions' => $relatedBankTransactions,
            ])->render();
        } else {
            $html = view('print-bank-pdf', [
                'case' => $case, 
                'relatedBankTransactions' => $relatedBankTransactions,
            ])->render();
        }

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        $filename = ($case->outward_no ?? 'transaction_' . $case->id) . '.pdf';

        $acknowledgementNo = $case->acknowledgement_no ?? $case->id;
        $bankName = $case->bank_name ?? '';
        $filename = '';
        if (!empty($acknowledgementNo) && !empty($bankName) && !empty($case->outward_no)) {
            $filename = $bankName . ' - ' . $acknowledgementNo . ' - ' . $case->outward_no . '.pdf';
        } elseif (!empty($acknowledgementNo) && !empty($case->outward_no)) {
            $filename = $acknowledgementNo . ' - ' . $case->outward_no . '.pdf';
        } elseif (!empty($case->outward_no)) {
            $filename = 'transaction_' . $case->outward_no . '.pdf';
        } else {
            $filename = 'transaction_' . $case->id . '.pdf';
        }

        return $dompdf->stream($filename, ['Attachment' => true]);
    }
}
