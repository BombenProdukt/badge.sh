<?php

declare(strict_types=1);

namespace App\Badges\ROS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ROS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'ROS Index';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
