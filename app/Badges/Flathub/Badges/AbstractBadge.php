<?php

declare(strict_types=1);

namespace App\Badges\Flathub\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Flathub\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Flathub';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
