<?php

declare(strict_types=1);

namespace App\Badges\Treeware\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Treeware\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Treeware';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
