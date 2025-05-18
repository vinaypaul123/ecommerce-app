<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactiveUserNotification;
use Carbon\Carbon;

class NotifyInactiveUsers extends Command
{
    protected $signature = 'notify:inactive-users';
    protected $description = 'Notify users who have been inactive for 30+ days';

    public function handle()
    {
        $thresholdDate = Carbon::now()->subDays(30);

        $users = User::whereNull('last_login_at')
                    ->orWhere('last_login_at', '<', $thresholdDate)
                    ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new InactiveUserNotification($user));
        }

        $this->info("Notified " . $users->count() . " inactive users.");
    }
}
