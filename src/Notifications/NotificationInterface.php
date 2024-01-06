<?php

namespace Tallerrs\BharPhyit\Notifications;

use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

interface NotificationInterface
{
    public function sendNotifications(BharPhyitErrorLog $bharPhyitErrorLog): void;
}