<?php

declare(strict_types=1);

namespace App\Badges\Coveralls\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Coveralls\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Coveralls';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
