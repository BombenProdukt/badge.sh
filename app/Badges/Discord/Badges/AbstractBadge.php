<?php

declare(strict_types=1);

namespace App\Badges\Discord\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Discord\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Discord';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
