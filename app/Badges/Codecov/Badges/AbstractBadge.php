<?php

declare(strict_types=1);

namespace App\Badges\Codecov\Badges;

use App\Badges\Codecov\Client;
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

    final public function service(): string
    {
        return 'Codecov';
    }
}
