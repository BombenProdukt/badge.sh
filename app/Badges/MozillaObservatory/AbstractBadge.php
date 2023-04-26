<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Mozilla Observatory';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
