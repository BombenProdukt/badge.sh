<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\DevRant\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'devRant';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
