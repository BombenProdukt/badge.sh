<?php

declare(strict_types=1);

namespace App\Badges\Jira;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Jira';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
