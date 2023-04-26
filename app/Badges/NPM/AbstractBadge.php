<?php

declare(strict_types=1);

namespace App\Badges\NPM;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'npm';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
