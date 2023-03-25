<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Ubuntu\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Ubuntu';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
