<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Mastodon\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Mastodon';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
