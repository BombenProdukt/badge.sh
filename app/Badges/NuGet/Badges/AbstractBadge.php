<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\NuGet\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'NuGet';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
