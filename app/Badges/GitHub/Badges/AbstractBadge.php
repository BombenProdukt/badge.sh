<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\GitHub\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'GitHub';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
