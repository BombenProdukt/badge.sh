<?php

declare(strict_types=1);

namespace App\Badges\MELPA\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\MELPA\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'MELPA';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
