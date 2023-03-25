<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\MozillaAddOns\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Mozilla Add-ons';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
