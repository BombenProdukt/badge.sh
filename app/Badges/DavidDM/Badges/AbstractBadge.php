<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\DavidDM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'DavidDM';
    protected array $statusInfo = [
        'insecure' => ['insecure', 'red'],
        'outofdate' => ['out of date', 'orange'],
        'notsouptodate' => ['up to date', 'yellow'],
        'uptodate' => ['up to date', 'green'],
        'none' => ['none', 'green'],
    ];

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
