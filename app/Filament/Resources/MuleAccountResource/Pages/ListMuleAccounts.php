<?php


namespace App\Filament\Resources\MuleAccountResource\Pages;

use App\Filament\Resources\MuleAccountResource;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MuleAccountImport;
use Illuminate\Support\Facades\Storage;
use Filament\Tables;
use Filament\Notifications\Notification;

class ListMuleAccounts extends ListRecords
{
    protected static string $resource = MuleAccountResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Action::make('importExcel')
            ->label('Import from Excel')
            ->color('success')
            ->form([
                FileUpload::make('file')
                    ->label('Excel File (.xlsx)')
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->required()
                    ->disk('local') // or 'public', depending on your setup
                    ->directory('imports'),
            ])
                ->action(function (array $data) {
                    // $data['file'] is in livewire-tmp, so we move it
                    $filePath = Storage::disk('local')->path($data['file']);
                    Excel::import(new MuleAccountImport, $filePath);
                    
    
                  //  $this->notify('success', 'Mule Accounts imported successfully!');
                }),
        ];
    }
    
}
