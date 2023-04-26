<?php

declare(strict_types=1);

namespace App\Badges\Localizely;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ProgressBadge extends AbstractBadge
{
    protected string $route = '/localizely/progress/{user}/{repo}/{branch?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo): array
    {
        $response = $this->client->get($this->getRequestData('token'), $user, $repo);
        $languageCode = $this->getRequestData('languageCode');

        if (empty($languageCode)) {
            return $this->renderPercentage('localized', $response['reviewedProgress']);
        }

        return [
            'language' => $languageCode,
            'percentage' => collect($response['languages'])->find(fn (array $language) => $language['langCode'] === $languageCode)['reviewedProgress'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage($properties['language'], $properties['percentage']);
    }

    public function routeRules(): array
    {
        return [
            'languageCode' => ['nullable', 'string'],
            'token' => ['required', 'string'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'progress',
                path: '/localizely/progress/5cc34208-0418-40b1-8353-acc70c95f802/main?token=0f4d5e31a44f48dcbab966c52cfb0a67c5f1982186c14b85ab389a031dbc225a',
                data: $this->render(['language' => 'en-US', 'percentage' => 0]),
            ),
            new BadgePreviewData(
                name: 'progress for language',
                path: '/localizely/progress/5cc34208-0418-40b1-8353-acc70c95f802/main?token=0f4d5e31a44f48dcbab966c52cfb0a67c5f1982186c14b85ab389a031dbc225a&languageCode=en-US',
                data: $this->render(['language' => 'en-US', 'percentage' => 50]),
            ),
        ];
    }
}
