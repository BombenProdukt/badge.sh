<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Testspace\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Testspace';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
