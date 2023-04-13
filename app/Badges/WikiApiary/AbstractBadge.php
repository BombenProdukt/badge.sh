<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'WikiApiary';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
