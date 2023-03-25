<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PyPI\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'PyPI';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
