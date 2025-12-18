<?php

namespace App\Filament\Resources\RefundResource\Pages;

use App\Filament\Resources\RefundResource;
use App\Imports\RefundImport;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListRefunds extends ListRecords
{
    protected static string $resource = RefundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Actions\Action::make('import')
            //     ->label('Import Excel')
            //     ->icon('heroicon-o-arrow-up-tray')
            //     ->form([
            //         Forms\Components\FileUpload::make('file')
            //             ->label('Excel File')
            //             ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
            //             ->required()
            //             ->disk('public')
            //             ->directory('imports/refunds')
            //             ->visibility('private'),
            //     ])
            //     ->action(function (array $data) {
            //         try {
            //             $filePath = Storage::disk('public')->path($data['file']);
            //             $fileName = basename($data['file']);
                        
            //             // Import with acknowledgement_no repetition logic
            //             $import = new RefundImport($fileName);
            //             Excel::import($import, $filePath);
                        
            //             // Clean up uploaded file
            //             Storage::disk('public')->delete($data['file']);
                        
            //             Notification::make()
            //                 ->title('Import Successful')
            //                 ->success()
            //                 ->body('Refund records imported successfully. Acknowledgement numbers were automatically repeated for grouped rows.')
            //                 ->send();
                            
            //         } catch (\Exception $e) {
            //             // Clean up file on error
            //             if (isset($data['file'])) {
            //                 Storage::disk('public')->delete($data['file']);
            //             }
                        
            //             Notification::make()
            //                 ->title('Import Failed')
            //                 ->danger()
            //                 ->body('Error: ' . $e->getMessage())
            //                 ->send();
            //         }
            //     }),
            // Actions\Action::make('import_bulk')
            //     ->label('Import All Files from Folder')
            //     ->icon('heroicon-o-folder')
            //     ->color('success')
            //     ->requiresConfirmation()
            //     ->modalHeading('Import All Refund Files')
            //     ->modalDescription('This will import all Excel files from the refund folder. Files will be processed one by one.')
            //     ->action(function () {
            //         $refundFolder = public_path('refund');
            //         $imported = 0;
            //         $failed = 0;
                    
            //         if (!is_dir($refundFolder)) {
            //             Notification::make()
            //                 ->title('Folder Not Found')
            //                 ->danger()
            //                 ->body('Refund folder not found at: ' . $refundFolder)
            //                 ->send();
            //             return;
            //         }
                    
            //         $files = glob($refundFolder . '/*.xlsx');
                    
            //         foreach ($files as $file) {
            //             try {
            //                 $fileName = basename($file);
            //                 $import = new RefundImport($fileName);
            //                 Excel::import($import, $file);
            //                 $imported++;
            //             } catch (\Exception $e) {
            //                 $failed++;
            //                 Log::error('Failed to import refund file: ' . basename($file), [
            //                     'error' => $e->getMessage()
            //                 ]);
            //             }
            //         }
                    
            //         Notification::make()
            //             ->title('Bulk Import Completed')
            //             ->success()
            //             ->body("Successfully imported {$imported} file(s). " . ($failed > 0 ? "Failed: {$failed} file(s)." : ''))
            //             ->send();
            //     }),
        
          
          
            ];
    }
}

