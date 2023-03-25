<?php

declare(strict_types=1);

namespace App\Badges\Buildkite\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Buildkite\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Buildkite';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
