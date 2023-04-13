<?php

declare(strict_types=1);

namespace App\Badges\LuaRocks;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'LuaRocks';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
