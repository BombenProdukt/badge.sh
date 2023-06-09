<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'OSS Lifecycle';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
