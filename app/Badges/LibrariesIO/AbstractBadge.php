<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Libraries.io';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
