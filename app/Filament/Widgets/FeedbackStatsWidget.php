<?php

namespace App\Filament\Widgets;

use App\Models\ApplicationRecord;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FeedbackStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Feedback Statistics (Month-wise)';
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user && in_array($user->user_type, ['admin', 'sp_office']);
    }

    protected function getData(): array
    {
        $months = [];
        $pendingData = [];
        $completedData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');

            $pending = ApplicationRecord::whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->where('status', 'pending')
                ->count();

            $completed = ApplicationRecord::whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->where('status', 'completed')
                ->count();

            $pendingData[] = $pending;
            $completedData[] = $completed;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pending',
                    'data' => $pendingData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Completed',
                    'data' => $completedData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.8)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $months,
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
                    ticks: { stepSize: 1 }
                },
                x: {
                    ticks: { maxRotation: 45, minRotation: 45 }
                }
            },
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            onClick(event, elements) {
                if (elements.length > 0) {
                    const chart = this;
                    const el = elements[0];
                    const datasetLabel = chart.data.datasets[el.datasetIndex].label;
                    const label = chart.data.labels[el.index];

                    if (!datasetLabel || !label) return;

                    const status = datasetLabel.toLowerCase();
                    const [monthName, year] = label.split(' ');
                    const monthMap = {
                        Jan: '01', Feb: '02', Mar: '03', Apr: '04', May: '05', Jun: '06',
                        Jul: '07', Aug: '08', Sep: '09', Oct: '10', Nov: '11', Dec: '12'
                    };
                    const monthNum = monthMap[monthName] || '01';

                    const startDate = `${year}-${monthNum}-01`;
                    const endDate = new Date(year, parseInt(monthNum), 0).toISOString().split('T')[0];

                    const url = `/admin/application-records?tableFilters[status][value]=${encodeURIComponent(status)}&tableFilters[date][from]=${startDate}&tableFilters[date][to]=${endDate}`;
                    window.location.href = url;
                }
            }
        }
        JS);
    }
}
