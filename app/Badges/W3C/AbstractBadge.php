<?php

declare(strict_types=1);

namespace App\Badges\W3C;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'W3C Validation';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
