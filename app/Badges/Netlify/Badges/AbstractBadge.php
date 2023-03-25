<?php

declare(strict_types=1);

namespace App\Badges\Netlify\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Netlify\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Netlify';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
