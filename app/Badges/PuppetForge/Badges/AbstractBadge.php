<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PuppetForge\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Puppet Forge';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
