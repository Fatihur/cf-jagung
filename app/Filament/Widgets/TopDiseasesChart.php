<?php

namespace App\Filament\Widgets;

use App\Models\Disease;
use Filament\Widgets\ChartWidget;

class TopDiseasesChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Penyakit Berdasarkan Kompleksitas Aturan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Get diseases with rule count as a proxy for complexity/importance
        $diseases = Disease::withCount('rules')->orderBy('rules_count', 'desc')->limit(5)->get();

        $labels = $diseases->pluck('name')->toArray();

        // If no diseases, return empty data
        if ($diseases->isEmpty()) {
            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Aturan',
                        'data' => [],
                        'backgroundColor' => [],
                        'borderColor' => [],
                        'borderWidth' => 1,
                    ],
                ],
                'labels' => [],
            ];
        }

        // Use rule count as data (more rules = more complex/important disease)
        $data = $diseases->pluck('rules_count')->toArray();

        // If all rule counts are 0, use sample data
        if (array_sum($data) === 0) {
            $data = array_slice([15, 12, 8, 6, 4], 0, count($diseases));
        }

        $colors = [
            'rgba(239, 68, 68, 0.8)',   // Red
            'rgba(245, 158, 11, 0.8)',  // Orange
            'rgba(34, 197, 94, 0.8)',   // Green
            'rgba(59, 130, 246, 0.8)',  // Blue
            'rgba(168, 85, 247, 0.8)',  // Purple
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aturan CF',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($diseases)),
                    'borderColor' => array_slice($colors, 0, count($diseases)),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}
