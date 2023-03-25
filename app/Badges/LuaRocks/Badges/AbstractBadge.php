<?php

declare(strict_types=1);

namespace App\Badges\LuaRocks\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\LuaRocks\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'LuaRocks';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
