<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\Ansible\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Ansible';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
