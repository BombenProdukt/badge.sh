<?php

declare(strict_types=1);

namespace App\Badges\POEditor\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ProgressBadge extends AbstractBadge
{
    public function handle(string $apiToken, string $projectId, string $languageCode): array
    {
        $response = $this->client->get($apiToken, $projectId, $languageCode);
        $language = collect($response['result'])->firstWhere('code', $languageCode);

        return [
            'language' => $language['name'],
            'percentage' => $language['percentage'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($properties['language'], $properties['percentage']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/poeditor/progress/{apiToken}/{projectId}/{languageCode}',
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
            '/poeditor/progress/abc123def456/323337/fr' => 'progress',
        ];
    }
}
