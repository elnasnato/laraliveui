<?php

namespace Laraliveui;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laraliveui\LaraliveuiManager
 */
class Laraliveui extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'laraliveui';
    }
}
