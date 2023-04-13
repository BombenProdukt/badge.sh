<?php

declare(strict_types=1);

namespace App\Badges\PackageControl;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Package Control';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
