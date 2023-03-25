<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\DUB\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'DUB';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
