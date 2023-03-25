<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ElmPackage\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Elm Package';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
