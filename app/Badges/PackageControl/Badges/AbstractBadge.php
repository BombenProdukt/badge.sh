<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PackageControl\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Package Control';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
