<?php

declare(strict_types=1);

namespace App\Badges\Tokei\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Tokei\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Tokei';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
