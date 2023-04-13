<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Greasy Fork';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
