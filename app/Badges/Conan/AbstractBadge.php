<?php

declare(strict_types=1);

namespace App\Badges\Conan;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Conan Center';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
