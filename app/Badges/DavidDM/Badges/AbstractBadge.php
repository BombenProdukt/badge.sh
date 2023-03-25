<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Badges\Concerns\BelongsToService;
use App\Badges\Concerns\HasPreviews;
use App\Badges\Concerns\HasRequest;
use App\Badges\Concerns\HasRoute;
use App\Badges\Concerns\HasTemplates;
use App\Badges\DavidDM\Client;
use App\Contracts\Badge;

abstract class AbstractBadge implements Badge
{
    use BelongsToService;
    use HasPreviews;
    use HasRequest;
    use HasRoute;
    use HasTemplates;
    protected array $statusInfo = [
        'insecure' => ['insecure', 'red'],
        'outofdate' => ['out of date', 'orange'],
        'notsouptodate' => ['up to date', 'yellow'],
        'uptodate' => ['up to date', 'green'],
        'none' => ['none', 'green'],
    ];

    /**
     * The service that this badge belongs to.
     */
    protected string $service = 'DavidDM';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
