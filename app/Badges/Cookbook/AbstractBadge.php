<?php

declare(strict_types=1);

namespace App\Badges\Cookbook;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Cookbook';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
