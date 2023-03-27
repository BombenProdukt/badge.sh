<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FlutterPlatformBadge extends AbstractBadge
{
    protected string $route = '/pub/flutter-platform/{package:wildcard}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];

        return [
            'platforms' => $this->parseTags($pubScores['panaReport']['derivedTags'], 'platform'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'flutter',
            'message' => $properties['platforms'] ? \implode('|', $properties['platforms']) : 'unknown',
            'messageColor' => $properties['platforms'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'flutter-platform',
                path: '/pub/flutter-platform/xml',
                data: $this->render(['platforms' => ['android', 'ios', 'web']]),
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
