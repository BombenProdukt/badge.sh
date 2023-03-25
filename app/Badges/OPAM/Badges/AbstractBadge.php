<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OPAM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'OPAM';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
