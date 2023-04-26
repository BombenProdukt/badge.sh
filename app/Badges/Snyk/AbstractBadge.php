<?php

declare(strict_types=1);

namespace App\Badges\Snyk;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Snyk';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
