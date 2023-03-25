<?php

declare(strict_types=1);

namespace App\Badges\VPM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\VPM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'VPM';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
