<?php

declare(strict_types=1);

namespace App\Badges\Cookbook\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Cookbook\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Cookbook';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
