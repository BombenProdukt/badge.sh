<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Reddit\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Reddit';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
