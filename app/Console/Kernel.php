<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\UpdateCotizacionVencidas::class,
        Commands\UpdateOtAtrasada::class,
        Commands\NotificarOtSinEntregar::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('schedule:vencida')->everyMinute();

        $schedule->command('schedule:otatrasada')->weekdays()->at('08:15');
        $schedule->command('schedule:otatrasada')->weekdays()->at('14:45');

        $schedule->command('schedule:otnoentregada')->weekdays()->at('08:15');
        $schedule->command('schedule:otnoentregada')->weekdays()->at('14:45');
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
