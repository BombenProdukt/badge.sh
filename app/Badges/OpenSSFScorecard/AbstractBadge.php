<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'OpenSSF Scorecard';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
