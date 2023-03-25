<?php

declare(strict_types=1);

namespace App\Badges\Swagger\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Swagger\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Swagger';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
