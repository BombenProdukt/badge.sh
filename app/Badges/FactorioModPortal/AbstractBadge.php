<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Factorio Mod Portal';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
