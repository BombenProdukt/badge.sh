<?php

declare(strict_types=1);

namespace App\Badges\DavidDM;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'DavidDM';

    protected array $statusInfo = [
        'insecure' => ['insecure', 'red.600'],
        'outofdate' => ['out of date', 'orange.600'],
        'notsouptodate' => ['up to date', 'yellow.600'],
        'uptodate' => ['up to date', 'green.600'],
        'none' => ['none', 'green.600'],
    ];

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
