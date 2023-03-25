<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\WAPM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'WebAssembly Package Manager';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
