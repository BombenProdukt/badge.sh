<?php

declare(strict_types=1);

namespace App\Badges\OhDear;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Oh Dear';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
