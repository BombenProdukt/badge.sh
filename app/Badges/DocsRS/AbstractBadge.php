<?php

declare(strict_types=1);

namespace App\Badges\DocsRS;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'docs.rs';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
