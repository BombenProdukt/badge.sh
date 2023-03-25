<?php

declare(strict_types=1);

namespace App\Badges\Codecov\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Codecov\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Codecov';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
