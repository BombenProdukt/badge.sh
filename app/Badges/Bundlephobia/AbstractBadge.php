<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bundlephobia';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
