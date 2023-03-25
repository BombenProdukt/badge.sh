<?php

declare(strict_types=1);

namespace App\Badges\SymfonyInsight\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\SymfonyInsight\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Symfony';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
