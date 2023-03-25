<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\NPMS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'npms';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
