<?php

declare(strict_types=1);

namespace App\Badges\GradlePluginPortal\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\GradlePluginPortal\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Gradle Plugin Portal';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
