<?php

declare(strict_types=1);

namespace App\Badges\Cirrus\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Cirrus\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Cirrus';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
