<?php

namespace App\Filament\Widgets;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\DiseaseSymptomRule;
use App\Models\Diagnosis;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Penyakit', Disease::count())
                ->description('Jumlah penyakit dalam database')
                ->descriptionIcon('heroicon-m-bug-ant')
                ->color('danger'),

            Stat::make('Total Gejala', Symptom::count())
                ->description('Jumlah gejala yang terdaftar')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info'),

            Stat::make('Aturan CF', DiseaseSymptomRule::count())
                ->description('Jumlah aturan Certainty Factor')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('warning'),

            Stat::make('Total Diagnosis', Diagnosis::count())
                ->description('Diagnosis yang telah dilakukan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Pengguna Aktif', User::count())
                ->description('Total pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Diagnosis Hari Ini', Diagnosis::whereDate('created_at', today())->count())
                ->description('Diagnosis yang dilakukan hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('gray'),
        ];
    }
}
