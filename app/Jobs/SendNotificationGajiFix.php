<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\EmailNotification;
use App\Notifications\GajiFixNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationGajiFix implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::where('status_kerja',1)->where('email','!=','alazca758@gmail.com')->get();

        foreach ($users as $user) {
            $user->notify(new GajiFixNotification());
        }
    }
}
