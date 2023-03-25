<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bower\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bower';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
