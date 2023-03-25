<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Crates\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Crates';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
