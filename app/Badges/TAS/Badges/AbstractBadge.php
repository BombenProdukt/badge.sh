<?php

declare(strict_types=1);

namespace App\Badges\TAS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\TAS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'TAS';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
