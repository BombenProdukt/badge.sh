<?php

declare(strict_types=1);

namespace App\Badges\POEditor;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ProgressBadge extends AbstractBadge
{
    protected string $route = '/poeditor/progress/{apiToken}/{projectId}/{languageCode}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'progress',
                path: '/poeditor/progress/abc123def456/323337/fr',
                data: $this->render(['language' => 'French', 'percentage' => 0]),
            ),
        ];
    }
}
