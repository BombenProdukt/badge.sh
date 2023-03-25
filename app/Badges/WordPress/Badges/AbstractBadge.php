<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\WordPress\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'WordPress';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
