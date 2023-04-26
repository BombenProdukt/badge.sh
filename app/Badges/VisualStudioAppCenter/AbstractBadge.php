<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Visual Studio App Center';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
