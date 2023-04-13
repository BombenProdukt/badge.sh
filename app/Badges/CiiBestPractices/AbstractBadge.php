<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CII Best Practices';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
