<?php

declare(strict_types=1);

namespace App\Badges\Fedora\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Fedora\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Fedora';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
