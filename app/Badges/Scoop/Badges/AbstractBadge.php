<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Scoop\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Scoop';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
