<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Chrome Web Store';

    protected array $deprecated = [
        '2023-06-12' => 'Deprecated due to Puppeteer requirement that lacks ARM64 support.',
    ];

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
