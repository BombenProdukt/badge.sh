<?php

declare(strict_types=1);

namespace App\Badges\NodePing\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\NodePing\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'NodePing';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
