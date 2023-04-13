<?php

declare(strict_types=1);

namespace App\Badges\JetBrains;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'JetBrains Plugins';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
