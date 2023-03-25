<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\FactorioModPortal\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Factorio Mod Portal';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
