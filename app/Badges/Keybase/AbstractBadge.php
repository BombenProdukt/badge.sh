<?php

declare(strict_types=1);

namespace App\Badges\Keybase;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Keybase';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
