<?php

declare(strict_types=1);

namespace App\Badges\MavenCentral\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\MavenCentral\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Maven Central';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
