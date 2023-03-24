<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge extends AbstractBadge
{
    public function handle(string $distribution): array
    {
        return [
            'label'        => 'size',
            'message'      => FormatBytes::execute($this->client->get("release/{$distribution}")['stat']['size']),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/cpan/size/{distribution}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cpan/size/Moose' => 'size',
        ];
    }
}
