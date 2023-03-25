<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\MozillaObservatory\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Mozilla Observatory';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
