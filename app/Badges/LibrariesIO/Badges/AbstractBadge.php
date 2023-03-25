<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\LibrariesIO\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Libraries.io';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
