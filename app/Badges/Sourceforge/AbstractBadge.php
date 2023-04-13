<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'SourceForge';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
