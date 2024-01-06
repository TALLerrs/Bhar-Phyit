<?php

namespace Tallerrs\BharPhyit\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

class ExceptionNotification
{
    // use Queueable;

    private $notification;

    public function to(string $notificationChannel): self
    {
        switch ($notificationChannel) {
            case 'slack':
                $this->notification = new SlackNotification();
                break;
            default:
                abort(500, "server error");
        }

        return $this;
    }

    public function send(BharPhyitErrorLog $bharPhyitErrorLog)
    {    
        return $this->notification->sendNotifications($bharPhyitErrorLog);
    }


    public function toSlack()
    {
        $jsonMessage = [
            'attachments' => [
                [
                    'color' => '#FF0000', // Red for errors
                    'title' => 'Error Occurred',
                    'text' => 'Error Message', // Include error message
                    'fields' => [
                        [
                            'title' => 'Severity',
                            'value' => "",
                            'short' => true,
                        ],
                        [
                            'title' => 'Stack Trace',
                            'value' => '2',
                            'short' => false
                        ],
                        // ... other fields as needed
                    ]
                ]
            ]
        ];

        (new \GuzzleHttp\Client())
            ->post(config('slack.webhook_url'), 
            [
                'json' => $jsonMessage
            ]);
    }
}