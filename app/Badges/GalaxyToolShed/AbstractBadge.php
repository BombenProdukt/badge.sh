<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Galaxy Tool Shed';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
