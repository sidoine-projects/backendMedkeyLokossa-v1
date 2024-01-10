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

    protected $commands = [

        \App\Console\Commands\SynchroniserEncaissements::class,
        \App\Console\Commands\SynchroniserDecaissements::class,
        \App\Console\Commands\SynchroniserPatients::class,
        \App\Console\Commands\SynchroniserPayements::class,
        \App\Console\Commands\SynchroniserFactures::class,
        \App\Console\Commands\SynchroniserEspeces::class,
        \App\Console\Commands\synchroniserPatients::class,
        
        \App\Console\Commands\synchroniserTerminals::class,
        \App\Console\Commands\SynchroniserIndigencePatients::class,
        \App\Console\Commands\SynchroniserPriseEnChargePatients::class,
        \App\Console\Commands\SynchroniserAffectTerminals::class,
        \App\Console\Commands\SynchroniserUsers::class,
        \App\Console\Commands\ResetCashRegisterBalance::class,
    ];


    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->command('encaissements:synchroniser')->everyFiveMinutes();
        // $schedule->command('encaissements:synchroniser')->everyMinute()->appendOutputTo(storage_path('logs/scheduler_output.log'));
        $schedule->command('encaissements:synchroniser')->everyMinute();
        $schedule->command('decaissements:synchroniser')->everyMinute();
        $schedule->command('patients:synchroniser')->everyMinute();
        $schedule->command('payements:synchroniser')->everyMinute();
        $schedule->command('factures:synchroniser')->everyMinute();
        $schedule->command('especes:synchroniser')->everyMinute();
        $schedule->command('terminals:synchroniser')->everyMinute();
        $schedule->command('indigencepatients:synchroniser')->everyMinute();
        $schedule->command('priseenchargepatients:synchroniser')->everyMinute();
        $schedule->command('affectterminals:synchroniser')->everyMinute();
        $schedule->command('users:synchroniser')->everyMinute();
        $schedule->command('cashregister:resetbalance');

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
