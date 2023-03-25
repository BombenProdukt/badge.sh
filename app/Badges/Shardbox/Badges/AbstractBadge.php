<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Shardbox\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Shardbox';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
