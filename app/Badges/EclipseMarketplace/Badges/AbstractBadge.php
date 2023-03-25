<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\EclipseMarketplace\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Eclipse Marketplace';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
