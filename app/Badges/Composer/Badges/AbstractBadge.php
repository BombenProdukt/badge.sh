<?php

declare(strict_types=1);

namespace App\Badges\Composer\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Composer\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Composer';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
