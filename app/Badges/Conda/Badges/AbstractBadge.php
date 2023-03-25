<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Conda\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Conda';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
