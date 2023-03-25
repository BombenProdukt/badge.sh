<?php

declare(strict_types=1);

namespace App\Badges\RunKit\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\RunKit\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'RunKit';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
