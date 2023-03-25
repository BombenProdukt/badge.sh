<?php

declare(strict_types=1);

namespace App\Badges\Codeship\Badges;

use App\Badges\Codeship\Client;
use App\Badges\Concerns\BelongsToService;
use App\Badges\Concerns\HasPreviews;
use App\Badges\Concerns\HasRequest;
use App\Badges\Concerns\HasRoute;
use App\Badges\Concerns\HasTemplates;
use App\Contracts\Badge;

abstract class AbstractBadge implements Badge
{
    use BelongsToService;
    use HasPreviews;
    use HasRequest;
    use HasRoute;
    use HasTemplates;

    /**
     * The service that this badge belongs to.
     */
    protected string $service = 'CodeShip';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
