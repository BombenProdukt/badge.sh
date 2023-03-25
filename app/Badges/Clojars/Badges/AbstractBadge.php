<?php

declare(strict_types=1);

namespace App\Badges\Clojars\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Clojars\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Clojars';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
