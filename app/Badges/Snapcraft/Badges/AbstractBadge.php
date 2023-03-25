<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Snapcraft\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Snapcraft';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
