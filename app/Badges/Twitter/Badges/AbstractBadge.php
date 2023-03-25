<?php

declare(strict_types=1);

namespace App\Badges\Twitter\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Twitter\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Twitter';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
