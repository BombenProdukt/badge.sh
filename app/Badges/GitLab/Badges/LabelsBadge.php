<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LabelsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/issues-by-label/{repo:wildcard}/{label}/{state?}';

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo, string $label, ?string $state = null): array
    {
        $stateFilter = $state ? 'state:'.\mb_strtolower($state) : '';
        $response = $this->client->graphql($repo, "issues(labelName:\"{$label}\", {$stateFilter}) { count } label(title: \"{$label}\"){ color }");

        return [
            'label' => $label,
            'count' => $response['issues']['count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['label'], $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues by label',
                path: '/gitlab/issues-by-label/NickBusey/HomelabOS/Bug',
                data: $this->render(['label' => 'Bug', 'count' => '42']),
            ),
            new BadgePreviewData(
                name: 'open issues by label',
                path: '/gitlab/issues-by-label/NickBusey/HomelabOS/Enhancement/opened',
                data: $this->render(['label' => 'Enhancement', 'count' => '42']),
            ),
            new BadgePreviewData(
                name: 'closed issues by label',
                path: '/gitlab/issues-by-label/NickBusey/HomelabOS/Help%20wanted/closed',
                data: $this->render(['label' => 'Help wanted', 'count' => '42']),
            ),
        ];
    }
}
