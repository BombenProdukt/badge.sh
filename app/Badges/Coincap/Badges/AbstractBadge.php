<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Coincap\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CoinCap';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
