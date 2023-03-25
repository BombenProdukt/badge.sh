<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Packagist\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Packagist';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
