<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\CocoaPods\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'CocoaPods';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
