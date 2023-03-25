<?php

declare(strict_types=1);

namespace App\Badges\Coverity\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Coverity\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Coverity';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
