<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\FDroid\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'F-Droid';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
