<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Hackage\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Hackage';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
