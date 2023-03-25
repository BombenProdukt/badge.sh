<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OpenVSX\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Open VSX';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
