<?php

declare(strict_types=1);

namespace App\Badges\Bitrise\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Bitrise\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Bitrise';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
