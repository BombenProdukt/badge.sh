<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\DeepScan\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'DeepScan';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
