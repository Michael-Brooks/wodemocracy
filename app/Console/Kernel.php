<?php

namespace App\Console;

use App\Console\Commands;
use App\Jobs\SendDailyEmail;
use App\User;
use App\WOD;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // If in development call this
	    if(App::environment('local')) {

            /*$schedule->call(function () {
                $wod = new Commands\CreateVotingThread();
                $wod->create();
            })->everyMinute();

            $schedule->call(function () {
                $workout = new Commands\SetWinningWorkoutToWOD();
                $workout->set();
            })->everyMinute();*/

            $schedule->call(function () {
                $users = User::whereHas('subscription', function ($query) {
                    $query->where('subscription', 1);
                })->get();

                $wod = WOD::whereHas('workouts', function ($query) {
                    $query->where('won', 1);
                })->where('workout_date', Carbon::today())->first();
                foreach ($users as $user) {
                    dispatch(new SendDailyEmail($user, $wod));
                }
            })->everyMinute();


        } else {
            $schedule->call(function () {
                $wod = new Commands\CreateVotingThread();
                $wod->create();
            })->daily();

            $schedule->call(function () {
                $workout = new Commands\SetWinningWorkoutToWOD();
                $workout->set();
            })->daily();

            $schedule->call(function () {
                $users = User::whereHas('subscription', function ($query) {
                    $query->where('subscription', 1);
                })->get();

                $wod = WOD::whereHas('workouts', function ($query) {
                    $query->where('won', 1);
                })->where('workout_date', Carbon::today())->first();
                foreach ($users as $user) {
                    dispatch(new SendDailyEmail($user, $wod));
                }
            })->daily();
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
