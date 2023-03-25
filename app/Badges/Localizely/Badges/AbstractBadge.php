<?php

declare(strict_types=1);

namespace App\Badges\Localizely\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Localizely\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Localizely';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
