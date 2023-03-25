<?php

declare(strict_types=1);

namespace App\Badges\Matrix\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Matrix\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Matrix';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
