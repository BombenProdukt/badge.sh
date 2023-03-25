<?php

declare(strict_types=1);

namespace App\Badges\Codeship\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Codeship\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CodeShip';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
