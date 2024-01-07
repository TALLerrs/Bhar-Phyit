<?php

namespace Tallerrs\BharPhyit\Notifications\Channels;

use Illuminate\Support\Facades\Http;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Notifications\AbstractNotification;
use Tallerrs\BharPhyit\Notifications\NotificationInterface;
use Tallerrs\BharPhyit\Trait\BharPhyitUrl;

class SlackNotification extends AbstractNotification
{
    use BharPhyitUrl;

    public function sendNotifications(): void
    {
        try {
             (new \GuzzleHttp\Client())
                ->post(config('bhar-phyit.channels.slack.webhook_url'), 
                    [
                        'json' => $this->getFormattedMessage()
                    ]);
        } catch(\Exception $e) {
            abort(422, "Slack webhook is valid");
        }
    }

    public function getFormattedMessage(): array
    {
        return [
            'attachments' => [
                [
                    'color' => '#FF0000', // Red for errors
                    'title' => "Bhar Pyit Error Logs",
                    'text' => $this->bharPhyitErrorLog->title,
                    'fields' => [
                        [
                            'title' => 'Bhar Phyit Error Detail Page',
                            'value' => $this->getBharPyitDetailUrl($this->bharPhyitErrorLog->id),
                            'short' => false,
                        ],
                        [
                            'title' => 'Error Happend Url',
                            'value' => $this->bharPhyitErrorLog->url,
                            'short' => true
                        ],
                        [
                            'title' => 'Method',
                            'value' => $this->bharPhyitErrorLog->method,
                            'short' => true
                        ],
                        [
                            'title' => 'File Path',
                            'value' => $this->bharPhyitErrorLog->file_path,
                            'short' => true
                        ],
                        [
                            'title' => 'Line Number',
                            'value' => $this->bharPhyitErrorLog->line,
                            'short' => true
                        ],
                    ]
                ]
            ]
        ];
    }
}