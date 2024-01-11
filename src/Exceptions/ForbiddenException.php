<?php

namespace Tallerrs\BharPhyit\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenException extends HttpException
{
    /**
     * Create a new exception instance.
     *
      * @param string $message
     * 
     * @return static
     */
    public static function make(String $message = "")
    {
        return new static(403, $message);
    }
}
