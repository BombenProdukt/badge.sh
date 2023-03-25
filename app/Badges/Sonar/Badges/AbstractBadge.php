<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Sonar\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Sonar';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
