<?php

declare(strict_types=1);

namespace App\Badges\LaravelForge\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\LaravelForge\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Laravel Forge';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
