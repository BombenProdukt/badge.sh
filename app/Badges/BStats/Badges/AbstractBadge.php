<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\BStats\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'bStats';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
