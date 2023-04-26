<?php

declare(strict_types=1);

namespace App\Badges\GradlePluginPortal;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Gradle Plugin Portal';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
