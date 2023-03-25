<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Homebrew\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Homebrew';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
