<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Pengaduan;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Menunggu', Pengaduan::where('status', 'Menunggu')->count()),
            Stat::make('Proses', Pengaduan::where('status', 'Proses')->count()),
            Stat::make('Selesai', Pengaduan::where('status', 'Selesai')->count()),
        ];
    }
}