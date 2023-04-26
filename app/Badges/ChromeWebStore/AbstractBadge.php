<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Chrome Web Store';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
