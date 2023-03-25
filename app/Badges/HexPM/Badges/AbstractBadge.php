<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\HexPM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'hex.pm';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
