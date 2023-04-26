<?php

declare(strict_types=1);

namespace App\Badges\HackerNews;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Hacker News';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
