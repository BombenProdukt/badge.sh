<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Haxelib\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Haxelib';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
