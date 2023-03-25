<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Sourceforge\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'SourceForge';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
