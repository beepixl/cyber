<?php

namespace App\Filament\Resources\RefundResource\Pages;

use App\Filament\Resources\RefundResource;
use App\Models\Refund;
use Filament\Resources\Pages\Page;
use Dompdf\Dompdf;
use Dompdf\Options;

class PrintRefund extends Page
{
    protected static string $resource = RefundResource::class;

    protected static string $view = 'print-refund-pdf';

    public function generatePdf($record = null)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('tempDir', '/tmp');
        $options->set('chroot', __DIR__);
        $options->set('isPhpEnabled', true);
        
        $dompdf = new Dompdf($options);

        $refund = Refund::findOrFail($record);
        
        // Get all refunds with the same bank name and acknowledgement number for grouping
        $relatedRefunds = Refund::where('suspect_bank_account_name', $refund->suspect_bank_account_name)
            ->whereNotNull('suspect_bank_account_name')
            ->where('acknowledgement_no', $refund->acknowledgement_no)
            ->get();

        $html = view('print-refund-pdf', [
            'refund' => $refund,
            'relatedRefunds' => $relatedRefunds,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        // Set the PDF title using acknowledgement number and bank name
        $acknowledgementNo = $refund->acknowledgement_no ?? $refund->id;
        $bankName = $refund->suspect_bank_account_name ?? '';
        $title = "Refund Notice - " . $acknowledgementNo;
        if (!empty($bankName)) {
            $title .= " - " . $bankName;
        }
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->set_option('pdfTitle', $title); // For Dompdf >= 2.0
        $dompdf->render();
        
        $filename = 'refund_notice_' . ($refund->acknowledgement_no ?? $refund->id) . '.pdf';
        $dompdf->stream($filename, ["Attachment" => false]);
    }
}

