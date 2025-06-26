<?php

namespace App\Filament\Widgets;

use App\Models\AccusedProfile;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class StateAccusedProfilesChart extends ChartWidget
{
    protected static ?string $heading = 'Suspect Profiles by State';

    protected function getData(): array
    {
        $data = AccusedProfile::query()
            ->selectRaw('state, COUNT(*) as count')
            ->whereNull('case_id')
            ->groupBy('state')
            ->orderByDesc('count')
            ->get();

        $labels = $data->pluck('state')->toArray();
        $counts = $data->pluck('count')->toArray();

        // Generate a color palette
        $palette = [
            '#141b4c', '#ffec00', '#e57373', '#64b5f6', '#81c784', '#ffd54f', '#ba68c8', '#4dd0e1', '#f06292', '#a1887f',
            '#90a4ae', '#dce775', '#ff8a65', '#9575cd', '#4caf50', '#fbc02d', '#f44336', '#00bcd4', '#8bc34a', '#ff9800',
        ];
        $backgroundColors = [];
        $borderColors = [];
        foreach ($labels as $i => $label) {
            $color = $palette[$i % count($palette)];
            $backgroundColors[] = $color;
            $borderColors[] = $color;
        }

        return [
            'datasets' => [
                [
                    'label' => 'No. of Suspect Profiles',
                    'data' => $counts,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                ],
            ],
            'labels' => $labels,
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
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const chartElement = elements[0];
                        const label = this.data.labels[chartElement.index];
                        if (label) {
                            window.location.href = `/admin/accused-profiles?tableFilters[state][value]=` + encodeURIComponent(label);
                        }
                    }
                }
            }
        JS);
    }
}
