<?php

declare(strict_types=1);

namespace App\Badges\CDNJS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\CDNJS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'cdnjs';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
