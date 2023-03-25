<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\GitLab\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'GitLab';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
