<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Atom Package';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
