<?php

declare(strict_types=1);

namespace App\Badges\Node\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Node\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Node';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
