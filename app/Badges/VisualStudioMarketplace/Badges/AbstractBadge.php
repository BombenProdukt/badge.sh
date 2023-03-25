<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\VisualStudioMarketplace\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Visual Studio Marketplace';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
