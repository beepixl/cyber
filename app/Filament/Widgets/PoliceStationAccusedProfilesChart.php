<?php

namespace App\Filament\Widgets;

use App\Models\AccusedProfile;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\View\View;

class PoliceStationAccusedProfilesChart extends ChartWidget
{
    protected static ?string $heading = 'Suspect Profiles by Police Station';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user && $user->user_type !== 'sp_office' && $user->user_type !== 'police_station';
    }

    protected function getData(): array
    {
        $data = AccusedProfile::query()
            ->selectRaw('police_station, COUNT(*) as count')
            ->whereNull('case_id')
            ->groupBy('police_station')
            ->orderBy('count', 'desc')
            ->get();

        $policeStations = $data->pluck('police_station')->toArray();
        $colors = [
            '#3366CC', '#DC3912', '#FF9900', '#109618', '#990099', '#0099C6', '#DD4477', '#66AA00', '#B82E2E', '#316395',
            '#994499', '#22AA99', '#AAAA11', '#6633CC', '#E67300', '#8B0707', '#329262', '#5574A6', '#3B3EAC', '#B77322',
        ];
        $backgroundColors = [];
        $colorCount = count($colors);
        foreach ($policeStations as $i => $station) {
            $backgroundColors[] = $colors[$i % $colorCount];
        }

        return [
            'datasets' => [
                [
                    'label' => 'No. of Suspect Profiles',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $backgroundColors,
                ],
            ],
            'labels' => $policeStations,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    // Add a method to handle chart click events
    protected function getListeners(): array
    {
        return [
            'onBarClick',
        ];
    }

    // This method will be called from the frontend JS
    // public function onBarClick($policeStation)
    // {
    //     // Dispatch a browser event or Livewire event to filter by police station
    //     $this->dispatchBrowserEvent('setPoliceStationFilter', [
    //         'police_station' => $policeStation,
    //     ]);
    // }

    // Override the render method to inject custom JS for click handling
    // public function render(): View
    // {
    //     return view('filament.widgets.police-station-accused-profiles-chart', [
    //         'widget' => $this,
    //     ]);
    // }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<'JS'
            {
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const chartElement = elements[0];
                        const label = this.data.labels[chartElement.index];
                        if (label) {
                            window.location.href = `http://navsaricyber.com/admin/accused-profiles?tableFilters[police_station][value]=` + encodeURIComponent(label);
                        }
                    }
                }
            }
        JS);
    }
}
