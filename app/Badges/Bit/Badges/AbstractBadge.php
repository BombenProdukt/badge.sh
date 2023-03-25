<?php

declare(strict_types=1);

namespace App\Badges\Bit\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bit\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bit';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
