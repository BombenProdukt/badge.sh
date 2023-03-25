<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Jira\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Jira';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
