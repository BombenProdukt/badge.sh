<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\CiiBestPractices\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CII Best Practices';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
