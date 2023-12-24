<?php

namespace Tallerrs\BharPhyit\Exceptions;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Throwable;

class Handler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {

    }
}