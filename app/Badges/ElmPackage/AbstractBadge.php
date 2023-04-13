<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Elm Package';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
