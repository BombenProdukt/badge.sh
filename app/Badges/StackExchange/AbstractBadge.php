<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Stack Exchange';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
