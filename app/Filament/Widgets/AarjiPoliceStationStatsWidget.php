<?php

namespace App\Filament\Widgets;

use App\Models\Aarji;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\AarjiResource\Pages\ListAarjis;

class AarjiPoliceStationStatsWidget extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Aarji Statistics by Police Station';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office';
    }

    protected function getTablePage(): string
    {
        return ListAarjis::class;
    }

    protected function getData(): array
    {
        // Use the filtered query from the table
        $query = $this->getPageTableQuery();

        // Get all police stations with their counts from the filtered data
        $policeStations = (clone $query)
            ->whereNotNull('police_station')
            ->groupBy('police_station')
            ->selectRaw('police_station')
            ->pluck('police_station')
            ->toArray();

        $closedData = [];
        $underProcessData = [];
        $firRegisteredData = [];

        foreach ($policeStations as $station) {
            // Count Closed applications using the filtered query
            $closed = (clone $query)
                ->where('police_station', $station)
                ->where('application_status', 'Closed')
                ->count();
            $closedData[] = $closed;

            // Count Under Process applications using the filtered query
            $underProcess = (clone $query)
                ->where('police_station', $station)
                ->where('application_status', 'Under Process')
                ->count();
            $underProcessData[] = $underProcess;

            // Count FIR Registered applications using the filtered query
            $firRegistered = (clone $query)
                ->where('police_station', $station)
                ->where('application_status', 'FIR Registered')
                ->count();
            $firRegisteredData[] = $firRegistered;
        }

        return [
            'datasets' => [
                [
                    'label' => 'FIR Registered',
                    'data' => $firRegisteredData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Under Process',
                    'data' => $underProcessData,
                    'backgroundColor' => 'rgba(255, 206, 86, 0.8)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Closed',
                    'data' => $closedData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $policeStations,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<'JS'
            {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const chartElement = elements[0];
                        const datasetIndex = chartElement.datasetIndex;
                        const dataIndex = chartElement.index;
                        const policeStation = this.data.labels[dataIndex];
                        const datasetLabel = this.data.datasets[datasetIndex].label;
                        
                        if (policeStation && datasetLabel) {
                            // Redirect to AarjiResource with filters
                            window.location.href = `/admin/aarjis?tableFilters[application_status][value]=${encodeURIComponent(datasetLabel)}`;
                        }
                    }
                }
            }
        JS);
    }
}

