<?php

declare(strict_types=1);

namespace App\Badges\POEditor\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\POEditor\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'POEditor';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
