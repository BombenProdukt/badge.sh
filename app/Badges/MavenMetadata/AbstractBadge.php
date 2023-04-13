<?php

declare(strict_types=1);

namespace App\Badges\MavenMetadata;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Maven Metadata';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
