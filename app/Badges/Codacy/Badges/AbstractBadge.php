<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Codacy\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Codacy';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
