<?php

declare(strict_types=1);

namespace App\Badges\JCenter\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\JCenter\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'JCenter';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
