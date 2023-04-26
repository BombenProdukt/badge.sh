<?php

declare(strict_types=1);

namespace App\Badges\Localizely;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Localizely';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
