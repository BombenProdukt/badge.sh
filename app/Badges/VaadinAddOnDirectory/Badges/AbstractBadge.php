<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\VaadinAddOnDirectory\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Vaadin Add-on Directory';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
