<?php

declare(strict_types=1);

namespace App\Badges\Depfu\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Depfu\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Depfu';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
