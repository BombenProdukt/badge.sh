<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\SecurityHeaders\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Security Headers';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
