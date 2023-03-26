<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class LabelsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/issues-by-label/{owner}/{repo}/{label}/{states:open,closed?}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $owner, string $repo, string $label, ?string $states = ''): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, $this->getQueryBody($label, $states));

        return [
            'label' => $label,
            'count' => $result['label'] ? $result['label']['issues']['totalCount'] : 0,
            'color' => $result['label'] ? $result['label']['color'] : 'gray.600',
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => FormatNumber::execute((float) $properties['count'] ?? 0),
            'messageColor' => $properties['color'] ? $properties['color'] : 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues by label',
                path: '/github/issues-by-label/nodejs/node/ES%20Modules',
                data: $this->render(['label' => 'Bug', 'count' => '1000', 'color' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'open issues by label',
                path: '/github/issues-by-label/atom/atom/help-wanted/open',
                data: $this->render(['label' => 'Bug', 'count' => '1000', 'color' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'closed issues by label',
                path: '/github/issues-by-label/rust-lang/rust/B-RFC-approved/closed',
                data: $this->render(['label' => 'Bug', 'count' => '1000', 'color' => 'red.600']),
            ),
        ];
    }

    private function getQueryBody(string $label, string $states): string
    {
        $issueFilter = $states ? '(states:['.\mb_strtoupper($states).'])' : '';

        return "label(name:\"{$label}\") { color, issues{$issueFilter} { totalCount } }";
    }
}
