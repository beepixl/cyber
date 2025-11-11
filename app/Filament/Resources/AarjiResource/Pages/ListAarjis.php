<?php
namespace App\Filament\Resources\AarjiResource\Pages;

use App\Filament\Resources\AarjiResource;
use App\Filament\Widgets\AarjiPoliceStationStatsWidget;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AarjiImport;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;

class ListAarjis extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = AarjiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
          
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AarjiPoliceStationStatsWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make('All'),
    //         'under_process' => Tab::make('Under Process')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->where('application_status', 'Under Process')),
    //         'fir_registered' => Tab::make('FIR Registered')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->where('application_status', 'FIR Registered')),
    //         'closed' => Tab::make('Closed')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->where('application_status', 'Closed')),
          
    //     ];
    // }

    // public function getDefaultActiveTab(): string | int | null
    // {
    //     return 'under_process';
    // }
}

