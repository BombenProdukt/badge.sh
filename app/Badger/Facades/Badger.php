<?php

declare(strict_types=1);

namespace App\Badger\Facades;

use Illuminate\Support\Facades\Facade;

final class Badger extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'badger';
    }
}
