<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\CTAN\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CTAN';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
