<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PackagePhobia\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Package Phobia';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
