<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\WikiApiary\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'WikiApiary';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
