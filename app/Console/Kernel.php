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
        // // pesan otomatis untuk mengisi amalan harian
        // if (date('H') > 19) {
        //     # pukul kurang dari jam 7 malam (exit) code...
        //     exit();
        // }else {
        //     # run auto message code...
        //     $schedule->command('message:daily')->everyMinute();
        // }

        $schedule->command('message:daily')->everyMinute();

        $schedule->command('message:reset')->dailyAt('03:00');
        // // reset status pesan amalan harian
        // if (date('H') == 23) {
        //     # tiap pukul 11 malam mengembalikan status pengiriman pesan code...
        //     $schedule->command('message:reset')->daily();
        // }
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
