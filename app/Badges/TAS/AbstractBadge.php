<?php

declare(strict_types=1);

namespace App\Badges\TAS;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'TAS';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
