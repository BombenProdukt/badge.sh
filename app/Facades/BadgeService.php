<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void  add(string $badge)
 * @method static array all()
 * @method static array previews()
 */
final class BadgeService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'badge.service';
    }
}
