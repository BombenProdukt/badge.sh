<?php

declare(strict_types=1);

namespace App\Badges\FDroid;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'F-Droid';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
