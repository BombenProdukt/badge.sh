<?php

declare(strict_types=1);

namespace App\Badges\Feedz\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Feedz\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Feedz';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
