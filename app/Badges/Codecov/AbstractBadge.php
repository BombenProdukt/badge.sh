<?php

declare(strict_types=1);

namespace App\Badges\Codecov;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Codecov';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
