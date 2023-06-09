<?php

declare(strict_types=1);

namespace App\Badges\OpenSuseBuildService;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'openSUSE Build Service';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
