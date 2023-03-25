<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Chocolatey\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Chocolatey';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
