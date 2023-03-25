<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\YouTube\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'YouTube';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
