<?php

namespace App\Console;

use App\Http\Controllers\LeadsController;
use App\Http\Controllers\UsersController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // Schedule the lead distribution to run every minute
        $schedule->call(function () {
            (new LeadsController)->distribute();
        })->everyMinute();

        // Schedule the restriction checks
        $schedule->call(function () {
            (new UsersController)->checkAndLiftRestrictions();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
