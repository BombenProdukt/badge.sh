<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Ore\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Ore';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
