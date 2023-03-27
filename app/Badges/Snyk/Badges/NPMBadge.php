<?php

declare(strict_types=1);

namespace App\Badges\Snyk\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class NPMBadge extends AbstractBadge
{
    protected string $route = '/snyk/npm/{project:wildcard}/{targetFile:wildcard?}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project, ?string $branch = null, ?string $targetFile = null): array
    {
        $svg = $this->client->get('test/npm/'.\implode('/', [$project, $branch]), $targetFile);

        \preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $matchesText);
        [$label, $message] = $matchesText[1];

        if (!\preg_match('/<path[^>]*?fill="([^"]+)"[^>]*?d="M[^0]/i', $svg, $matchesColor)) {
            return [];
        }

        $messageColor = \trim(\str_replace('#', '', $matchesColor[1]));

        if (null === $message || empty($messageColor)) {
            return [];
        }

        return [
            'label' => $label,
            'message' => $message,
            'messageColor' => $messageColor,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'] ?? 'vulnerabilities',
            'message' => $properties['message'],
            'messageColor' => $properties['messageColor'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'vulnerability scan (branch)',
                path: '/snyk/npm/@babel/core',
                data: $this->render(['message' => '0', 'messageColor' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'vulnerability scan (branch)',
                path: '/snyk/npm/@babel/core/6.x',
                data: $this->render(['message' => '0', 'messageColor' => 'green.600']),
            ),
        ];
    }
}
