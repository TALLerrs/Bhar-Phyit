<?php

namespace Tallerrs\BharPhyit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string js()
 * @method static \Tallerrs\BharPhyit\BharPhyit|string css(string|Htmlable|array|null $css = null)
 * @method static bool check(\Illuminate\Http\Request  $request)
 * 
 * @see \Tallerrs\BharPhyit\BharPhyit
 */
class BharPhyit extends Facade
{
    /**
     * Get the registered name of the component.
    */
    public static function getFacadeAccessor(): string
    {
        return \Tallerrs\BharPhyit\BharPhyit::class;
    }
}