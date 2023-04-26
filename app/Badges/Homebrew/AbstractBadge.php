<?php

declare(strict_types=1);

namespace App\Badges\Homebrew;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Homebrew';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
