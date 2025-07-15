<?php

namespace App\Filament\Resources\CrimeRecordCardResource\Pages;

use App\Filament\Resources\CrimeRecordCardResource;
use App\Models\CrimeRecordCard;
use Filament\Resources\Pages\Page;

class PrintCrimeRecordCard extends Page
{
    protected static string $resource = CrimeRecordCardResource::class;

    protected static string $view = 'filament.resources.crime-record-card-resource.pages.print-crime-record-card-pdf';

    public function generatePdf($record = null)
    {
        $crimeRecordCard = CrimeRecordCard::findOrFail($record);

        $html = view(self::$view, [
            'record' => $crimeRecordCard,
        ])->render();




        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'tempDir' => storage_path('app/mpdf-temp'),
            'fontDir' => [
                base_path('public/fonts/gujfonts'),
                base_path('public/fonts/Roboto/static'),
            ],
            'fontdata' => [
                'gujarati' => [
                    'R' => 'Shruti-Font.ttf', // make sure this font is valid and installed
                ],
                'roboto' => [
                    'R' => 'Roboto-Regular.ttf',
                    'B' => 'Roboto-Bold.ttf',
                    'I' => 'Roboto-Italic.ttf',
                    'BI' => 'Roboto-BoldItalic.ttf',
                ],
            ],
            'default_font' => 'roboto',
        ]);

        $mpdf->WriteHTML('
            <style>
                body { font-family: roboto; font-size: 11px; }
                .gujarati-text { font-family: gujarati; }
            </style>
        ', \Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('crime_record_card.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
