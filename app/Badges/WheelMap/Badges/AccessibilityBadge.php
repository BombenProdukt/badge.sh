<?php

declare(strict_types=1);

namespace App\Badges\WheelMap\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Templates\TextTemplate;
use App\Badges\WheelMap\Client;
use Illuminate\Routing\Route;

final class AccessibilityBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $nodeId): array
    {
        $accessibility = $this->client->node($nodeId);

        return TextTemplate::make('accessibility', $accessibility, match ($accessibility) {
            'yes'     => 'green.600',
            'limited' => 'yellow.600',
            'no'      => 'red.600',
            default   => 'gray.600',
        });
    }

    public function service(): string
    {
        return 'Wheelmap';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/wheelmap/accessibility/{nodeId}',
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
            '/wheelmap/accessibility/26699541' => 'version',
        ];
    }
}
