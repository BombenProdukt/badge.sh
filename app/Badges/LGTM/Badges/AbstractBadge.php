<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\LGTM\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'LGTM';
    protected array $languages = [
        'cpp' => 'c/c++',
        'csharp' => 'c#',
        'javascript' => 'js/ts',
    ];

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
