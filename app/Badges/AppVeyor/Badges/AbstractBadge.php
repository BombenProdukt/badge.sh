<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\AppVeyor\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'AppVeyor';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
