<?php

declare(strict_types=1);

namespace App\Badges\ReSharper\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ReSharper\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'JetBrains ReSharper Plugins';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
