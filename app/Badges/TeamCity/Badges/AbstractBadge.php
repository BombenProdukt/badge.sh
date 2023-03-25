<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\TeamCity\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'TeamCity';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
