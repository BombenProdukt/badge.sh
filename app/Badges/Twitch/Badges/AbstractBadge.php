<?php

declare(strict_types=1);

namespace App\Badges\Twitch\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Twitch\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Twitch';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
