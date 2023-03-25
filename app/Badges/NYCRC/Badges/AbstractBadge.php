<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\NYCRC\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = '.nycrc';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
