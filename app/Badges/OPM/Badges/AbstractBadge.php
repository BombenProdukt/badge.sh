<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OPM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'OPM';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
