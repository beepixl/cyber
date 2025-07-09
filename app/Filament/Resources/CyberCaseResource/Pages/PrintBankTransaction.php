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

        $case = BankTransaction::with('case')->find($record);
      


        if ($case->info_type == 'Instagram') {
            $html = view('print-instagram-pdf', [
                'case' => $case, // Fetch all cases or specific data
            ])->render();
        } else {
            $html = view('print-bank-pdf', [
                'case' => $case, // Fetch all cases or specific data
            ])->render();
        }

      //  return $html;

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        $dompdf->stream('cyber_cases.pdf', ['Attachment' => false]);
    }
}
