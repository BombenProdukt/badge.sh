<?php

declare(strict_types=1);

namespace App\Badges\REUSE\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\REUSE\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'REUSE';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
