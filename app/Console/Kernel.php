<?php

namespace App\Console;
use App\Models\SchedullingNotification;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
                SchedullingNotification::create([
                    'user_id' => $user->id,
                    'message' => "Hello {$user->email}, this is your notification."
                ]);
            }
        })->everyMinute();
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
