<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\JSDelivr\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'jsDelivr';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
