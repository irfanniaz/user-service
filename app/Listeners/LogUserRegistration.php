<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;
use App\Events\MyEvent;

class LogUserRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        Log::info('New user registered: ' . $user->email);

        // Read the log file
        $logFilePath = storage_path('logs/laravel.log');
        $logContents = file_get_contents($logFilePath);

        // Extract user data from log contents (parse as needed)
        // For demonstration, let's assume the user data is stored in JSON format
        $userData = [];

        foreach (explode("\n", $logContents) as $logLine) {
            // Parse log line as JSON
            $logData = json_decode($logLine, true);
            if (isset($logData['context']['message'])) {
                $userData[] = json_decode($logData['context']['message'], true);
            }
        }
        event(new MyEvent($userData));

    }
}
