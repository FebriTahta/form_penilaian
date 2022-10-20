<?php

namespace App\Console;

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
        // pesan otomatis untuk mengisi amalan harian
        if (date('H') < 19) {
            # code...
            exit();
        }else {
            # code...
            $schedule->command('message:daily')->everyMinute();
        }

        // reset status pesan amalan harian
        if (date('H') == 23) {
            # code...
            $schedule->command('message:reset')->daily();
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
