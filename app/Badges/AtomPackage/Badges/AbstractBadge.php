<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\AtomPackage\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Atom Package';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
