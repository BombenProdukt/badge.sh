<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Gitter\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Gitter';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
