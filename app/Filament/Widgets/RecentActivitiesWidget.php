<?php

namespace App\Filament\Widgets;

use App\Models\Diagnosis;
use App\Models\User;
use Filament\Widgets\Widget;

class RecentActivitiesWidget extends Widget
{
    protected static string $view = 'filament.widgets.recent-activities';
    protected static ?int $sort = 7;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $recentDiagnoses = Diagnosis::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentUsers = User::latest()
            ->limit(3)
            ->get();

        return [
            'recent_diagnoses' => $recentDiagnoses,
            'recent_users' => $recentUsers,
            'total_today' => Diagnosis::whereDate('created_at', today())->count(),
        ];
    }
}
