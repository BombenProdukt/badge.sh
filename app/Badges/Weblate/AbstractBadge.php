<?php

declare(strict_types=1);

namespace App\Badges\Weblate;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Weblate';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
