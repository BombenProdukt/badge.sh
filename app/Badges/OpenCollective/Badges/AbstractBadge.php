<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OpenCollective\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Open Collective';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
