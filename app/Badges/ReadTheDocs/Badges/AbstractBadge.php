<?php

declare(strict_types=1);

namespace App\Badges\ReadTheDocs\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\ReadTheDocs\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Read the Docs';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
