<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\AppleMusic\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Apple Music';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
