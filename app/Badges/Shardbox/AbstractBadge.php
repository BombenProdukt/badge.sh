<?php

declare(strict_types=1);

namespace App\Badges\Shardbox;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Shardbox';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
