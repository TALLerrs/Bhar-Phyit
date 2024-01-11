<?php

namespace Tallerrs\BharPhyit\Notifications;

use Tallerrs\BharPhyit\Models\BharPhyitErrorLog;

/**
 * Abstract class for implementing notifications.
 * 
 * This class serves as a base for different notification channels.
 * Subclasses must implement the 'sendNotifications' method to handle the actual notification logic,
 * and the 'getFormattedMessage' method to provide a formatted message.
 *
 * @abstract
 */
abstract class AbstractNotification
{
    /**
     * The BharPhyitErrorLog instance associated with the notification.
     * 
     * @var BharPhyitErrorLog
     */
    protected BharPhyitErrorLog $bharPhyitErrorLog;

    /**
     * Constructor for AbstractNotification.
     *
     * @param BharPhyitErrorLog $bharPhyitErrorLog The error log instance.
     */
    public function __construct(BharPhyitErrorLog $bharPhyitErrorLog)
    {
        $this->bharPhyitErrorLog = $bharPhyitErrorLog;
    }

    /**
     * Sends notifications using the implemented logic in subclasses.
     *
     * Subclasses must implement this method to define the notification behavior.
     *
     * @abstract
     * @return void
     */
    abstract public function sendNotifications(): void;

    /**
     * Gets the formatted message for the notification.
     *
     * Subclasses must implement this method to provide a formatted message.
     * The format may depend on the specific notification channel.
     *
     * @abstract
     * @return array The formatted message.
    */
    abstract protected function getFormattedMessage(): array;
}
