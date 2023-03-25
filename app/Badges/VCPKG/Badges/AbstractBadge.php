<?php

declare(strict_types=1);

namespace App\Badges\VCPKG\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\VCPKG\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'vcpkg';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
