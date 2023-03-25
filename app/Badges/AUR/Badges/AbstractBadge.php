<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\AUR\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'AUR';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
