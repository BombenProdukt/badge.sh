<?php

declare(strict_types=1);

namespace App\Badges\Feedz;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Feedz';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
