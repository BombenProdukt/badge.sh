<?php

declare(strict_types=1);

namespace App\Badges\Mastodon;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Mastodon';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
