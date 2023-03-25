<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bundlephobia\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bundlephobia';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
