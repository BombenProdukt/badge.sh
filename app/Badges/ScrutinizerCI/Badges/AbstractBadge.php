<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ScrutinizerCI\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Scrutinizer';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
