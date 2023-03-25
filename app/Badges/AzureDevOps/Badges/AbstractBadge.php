<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\AzureDevOps\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Azure Pipelines';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
