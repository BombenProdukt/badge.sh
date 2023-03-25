<?php

declare(strict_types=1);

namespace App\Badges\DocsRS\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\DocsRS\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'docs.rs';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
