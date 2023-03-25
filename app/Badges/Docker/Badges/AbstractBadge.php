<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Docker\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Docker';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
