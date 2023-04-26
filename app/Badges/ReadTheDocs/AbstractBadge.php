<?php

declare(strict_types=1);

namespace App\Badges\ReadTheDocs;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Read the Docs';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
