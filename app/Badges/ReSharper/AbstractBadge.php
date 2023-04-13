<?php

declare(strict_types=1);

namespace App\Badges\ReSharper;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'JetBrains ReSharper Plugins';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
