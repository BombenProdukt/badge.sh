<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Weblate\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Weblate';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
