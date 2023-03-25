<?php

declare(strict_types=1);

namespace App\Badges\Piwheels\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Piwheels\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'piwheels';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
