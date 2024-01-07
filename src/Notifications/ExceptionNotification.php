<?php

namespace Tallerrs\BharPhyit\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Notifications\Channels\MailNotification;
use Tallerrs\BharPhyit\Notifications\Channels\SlackNotification;
use Tallerrs\BharPhyit\Notifications\Channels\TelegramNotification;

class ExceptionNotification
{
    // use Queueable;

    private array $notifications;

    public function to(array $notificationChannels): self
    {
        foreach ($notificationChannels as $channel) {
            switch ($channel) {
                case 'slack':
                    $this->notifications[] = SlackNotification::class;
                    break;
                case 'telegram':
                    $this->notifications[] = TelegramNotification::class;
                    break;
                case 'mail':
                    $this->notifications[] = MailNotification::class;
                    break;
                default:
                    throw new \RuntimeException("Notification class '$channel' not found.",500);
                // Add more cases for other notification channels if needed
            }
        }

        return $this;
    }

    public function send(BharPhyitErrorLog $bharPhyitErrorLog)
    {    
        foreach($this->notifications as $notification) {
            if (class_exists($notification)) {
                (new $notification($bharPhyitErrorLog))->sendNotifications();
            } else {
                throw new \RuntimeException("Notification class '$notification' not found.",500);
            }
        }
    }
}