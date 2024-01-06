<?php

namespace Tallerrs\BharPhyit\Notifications;

use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

class SlackNotification implements NotificationInterface
{
    public function sendNotifications(BharPhyitErrorLog $bharPhyitErrorLog): void
    {
        // url, title, method, line
        $jsonMessage = [
            'attachments' => [
                [
                    'color' => '#FF0000', // Red for errors
                    'title' => "Bhar Pyit Error Logs",
                    'text' => $bharPhyitErrorLog->title,//json_decode($bharPhyitErrorLog->body),
                    'fields' => [
                        [
                            'title' => 'url',
                            'value' => "testing",//config('bhar-phyit.url')."/".$bharPhyitErrorLog->id,
                            'short' => true,
                        ],
                        [
                            'title' => 'Error Happend Url',
                            'value' => $bharPhyitErrorLog->url,
                            'short' => false
                        ],
                    ]
                ]
            ]
        ];

        (new \GuzzleHttp\Client())
            ->post(config('bhar-phyit.slack.webhook_url'), 
            [
                'json' => $jsonMessage
            ]);
    }
}