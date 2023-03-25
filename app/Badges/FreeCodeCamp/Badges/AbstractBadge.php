<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\FreeCodeCamp\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'FreeCodeCamp';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
