<?php

declare(strict_types=1);

namespace App\Badges\JitPack\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\JitPack\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'JitPack';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
