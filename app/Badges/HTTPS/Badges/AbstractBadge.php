<?php

declare(strict_types=1);

namespace App\Badges\HTTPS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\HTTPS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'HTTPS';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
