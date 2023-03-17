<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array all()
 * @method static void add(string $badge)
 * @method static array staticPreviews()
 * @method static array dynamicPreviews()
 */
final class BadgeService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'badge.service';
    }
}
