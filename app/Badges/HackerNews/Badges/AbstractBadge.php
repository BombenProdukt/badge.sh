<?php

declare(strict_types=1);

namespace App\Badges\HackerNews\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\HackerNews\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Hacker News';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
