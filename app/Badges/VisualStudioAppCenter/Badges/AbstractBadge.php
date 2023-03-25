<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\VisualStudioAppCenter\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Visual Studio App Center';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
