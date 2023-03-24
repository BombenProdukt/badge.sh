<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Badges\Bitbucket\Client;
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

    public function __construct(protected readonly Client $client)
    {
        //
    }

    public function service(): string
    {
        return 'Bitbucket';
    }
}
