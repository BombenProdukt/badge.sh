<?php

declare(strict_types=1);

namespace App\Badges\ClearlyDefined\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ClearlyDefined\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'ClearlyDefined';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
