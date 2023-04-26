<?php

declare(strict_types=1);

namespace App\Badges\ROS;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'ROS Index';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
