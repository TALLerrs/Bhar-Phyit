<?php

namespace Tallerrs\BharPhyit\Enums;

enum BharPhyitErrorLogStatus: string
{
    case UNREAD = 'unread';
    case READ = 'read';
    case RESOLVED = 'resolved';

    public static function __callStatic($name, $arguments)
    {
        return constant("self::{$name}")->value;
    }

    public static function getByKey(string $key): string
    {
        return constant("self::{$key}")->value;
    }

    public static function getByValue(string $value): string
    {
        return self::from($value)->value;
    }

    public static function unresolveStatuses(): array
    {
        return [
            self::UNREAD,
            self::READ,
        ];
    }
}
