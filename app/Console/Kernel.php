<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SyncPopularMovies::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // تحديث الأفلام الشائعة كل يوم
        $schedule->command('movies:sync-popular --pages=5')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
} 