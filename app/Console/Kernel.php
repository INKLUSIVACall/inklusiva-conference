<?php

namespace App\Console;

use App\Modules\Lag\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $meetings = Meeting::whereDate('start', Carbon::today())->get();
        foreach ($meetings as $meeting) {
            //if the meeting starts in 5 minutes, open the meeting
            if($meeting->start <= Carbon::now()->addMinutes(5) && $meeting->start >= Carbon::now()){
                $schedule->call(function() use ($meeting) {
                    $meeting->openMeeting();
                });
            }
        }

        $schedule->command('inklusiva:verify-jibri-availability')->everyMinute();
        $schedule->command('inklusiva:clean-up-jibri-cloud')->everyTwoHours();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
