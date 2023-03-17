<?php

declare(strict_types=1);

namespace App\Integrations\XO;

use App\Facades\BadgeService;
use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\XO\Badges\IndentBadge;
use App\Integrations\XO\Badges\SemicolonBadge;
use App\Integrations\XO\Badges\StatusBadge;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'XO';
    }

    public function register(): void
    {
        BadgeService::add(IndentBadge::class);
        BadgeService::add(SemicolonBadge::class);
        BadgeService::add(StatusBadge::class);
    }
}
