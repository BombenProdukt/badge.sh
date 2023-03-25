<?php

declare(strict_types=1);

namespace App\Badges\Repology\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Repology\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Repology';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
