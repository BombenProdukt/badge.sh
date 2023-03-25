<?php

declare(strict_types=1);

namespace App\Badges\Endpoint\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Endpoint\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Endpoint';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
