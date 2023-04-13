<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'PowerShell Gallery';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
