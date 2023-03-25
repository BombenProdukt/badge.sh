<?php

declare(strict_types=1);

namespace App\Badges\Bugzilla\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bugzilla\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bugzilla';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
