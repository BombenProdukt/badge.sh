<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Sourcegraph\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Sourcegraph';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
