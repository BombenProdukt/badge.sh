<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Apple Music';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
