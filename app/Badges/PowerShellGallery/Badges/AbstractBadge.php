<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PowerShellGallery\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'PowerShell Gallery';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
