<?php

namespace App\Console;

use App\Mail\AppointmentReminderMail;
use App\Models\appointment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $now = Carbon::now();
            $nextHour = $now->copy()->addHour();

            $appointments = appointment::whereDate('date', $now->toDateString())
                ->whereNull('reminder_send_at')
                ->where('status', 'active')
                ->whereBetween('time', [
                    $now->format('H:i:s'),
                    $nextHour->format('H:i:s')
                ])->get();

            /** @var appointment $appointment */
            foreach ($appointments as $appointment) {

                Mail::to($appointment->email)
                    ->send(new AppointmentReminderMail($appointment));

                $appointment->update([
                    'reminder_send_at' =>  Carbon::now()
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
