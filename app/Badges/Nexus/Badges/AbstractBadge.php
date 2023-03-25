<?php

declare(strict_types=1);

namespace App\Badges\Nexus\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Nexus\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Sonatype Nexus';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
