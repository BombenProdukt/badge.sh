<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bitbucket\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bitbucket';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
