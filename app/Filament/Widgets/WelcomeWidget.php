<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'user_name' => auth()->user()->name ?? 'Admin',
            'current_time' => now()->format('l, d F Y - H:i'),
        ];
    }
}
