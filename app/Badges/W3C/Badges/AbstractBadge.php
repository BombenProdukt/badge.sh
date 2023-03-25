<?php

declare(strict_types=1);

namespace App\Badges\W3C\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\W3C\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'W3C Validation';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
