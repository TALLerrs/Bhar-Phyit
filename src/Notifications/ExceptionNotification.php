<?php

namespace Tallerrs\BharPhyit\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tallerrs\BharPhyit\Exceptions\ForbiddenException;
use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Notifications\Channels\MailNotification;
use Tallerrs\BharPhyit\Notifications\Channels\SlackNotification;
use Tallerrs\BharPhyit\Notifications\Channels\TelegramNotification;

/**
 * Class ExceptionNotification
 *
 * This class handles the notification of exceptions using various channels such as Slack and other.............
 *
 * @package Tallerrs\BharPhyit\Notifications
 */
class ExceptionNotification
{
    // use Queueable;

    /**
     * The array of notification channels to be used.
     *
     * @var array
     */
    private array $notifications;

    /**
     * Set the notification channels to be used.
     *
     * @param array $notificationChannels An array of notification channels (e.g., ['slack', 'telegram', 'mail']).
     * 
     * @return $this
     * 
     * @throws \RuntimeException If the provided notification channel class is not found.
     */
    public function setNotificationChannels(array $notificationChannels): self
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
                    throw new \RuntimeException("Notification class ".$channel." not found");
                // Add more cases for other notification channels if needed
            }
        }

        return $this;
    }


    /**
     * Send notifications for the given error log through the specified channels.
     *
     * @param BharPhyitErrorLog $bharPhyitErrorLog The error log to be notified.
     * 
     * @return void
     * 
     * @throws \RuntimeException If the notification class is not found.
     */
     public function send(BharPhyitErrorLog $bharPhyitErrorLog): void
    {        
        foreach ($this->notifications as $notification) {
            try {
                (new $notification($bharPhyitErrorLog))->sendNotifications();
            } catch (\Exception $e) {
                error_log("Failed to send notification: " . $e->getMessage());
            }
        }
    }
}