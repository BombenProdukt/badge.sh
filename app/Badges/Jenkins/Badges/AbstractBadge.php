<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Jenkins\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Jenkins';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
