<?php

declare(strict_types=1);

namespace App\Badges\PeerTube;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'PeerTube';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}