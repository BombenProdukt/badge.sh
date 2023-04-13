<?php

declare(strict_types=1);

namespace App\Badges\ArchLinux;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Arch Linux';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
