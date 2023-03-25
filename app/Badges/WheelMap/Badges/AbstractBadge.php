<?php

declare(strict_types=1);

namespace App\Badges\WheelMap\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\WheelMap\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Wheelmap';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
