<?php

declare(strict_types=1);

namespace App\Badges\Codefactor\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Codefactor\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CodeFactor';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
