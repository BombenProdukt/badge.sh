<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\CRAN\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CRAN';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
