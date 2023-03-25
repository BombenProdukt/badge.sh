<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OpenSSFScorecard\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'OpenSSF Scorecard';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
