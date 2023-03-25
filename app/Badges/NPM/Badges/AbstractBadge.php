<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\NPM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'npm';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
