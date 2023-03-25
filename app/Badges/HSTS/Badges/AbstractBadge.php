<?php

declare(strict_types=1);

namespace App\Badges\HSTS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\HSTS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'HSTS';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
