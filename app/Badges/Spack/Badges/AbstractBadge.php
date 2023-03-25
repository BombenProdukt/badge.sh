<?php

declare(strict_types=1);

namespace App\Badges\Spack\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Spack\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Spack';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
