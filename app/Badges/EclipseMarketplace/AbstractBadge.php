<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Eclipse Marketplace';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
