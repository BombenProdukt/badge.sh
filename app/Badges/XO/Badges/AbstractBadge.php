<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\XO\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'XO';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
