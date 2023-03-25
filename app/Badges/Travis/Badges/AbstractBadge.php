<?php

declare(strict_types=1);

namespace App\Badges\Travis\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Travis\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Travis';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
