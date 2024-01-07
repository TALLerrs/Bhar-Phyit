<?php

namespace Tallerrs\BharPhyit\Notifications\Channels;

use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;
use Tallerrs\BharPhyit\Notifications\AbstractNotification;

class TelegramNotification extends AbstractNotification
{
    public function sendNotifications(): void
    {

    }

    public function getFormattedMessage(): array
    {
        return [];
    }
}