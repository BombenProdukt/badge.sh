<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DartPlatformBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/dart-platform/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];

        return [
            'versions' => $this->parseTags($pubScores['panaReport']['derivedTags'], 'sdk'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'dart',
            'message' => $properties['versions'] ? \implode('|', $properties['versions']) : 'unknown',
            'messageColor' => $properties['versions'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dart-platform',
                path: '/pub/dart-platform/rxdart',
                data: $this->render(['versions' => ['dart', 'flutter']]),
            ),
            new BadgePreviewData(
                name: 'dart-platform',
                path: '/pub/dart-platform/google_sign_in',
                data: $this->render(['versions' => ['dart', 'flutter']]),
            ),
        ];
    }

    private function parseTags(array $tags, string $group): array
    {
        $types = [];

        foreach ($tags as $tag) {
            if (!\str_starts_with($tag, $group.':')) {
                continue;
            }
            [, $name] = \explode(':', $tag);
            [$type] = \explode('-', $name);
            $types[] = $type;
        }

        return \array_values(\array_unique($types));
    }
}
