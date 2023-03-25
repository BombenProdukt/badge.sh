<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LabelsBadge extends AbstractBadge
{
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
            'message' => FormatNumber::execute($properties['count'] ?? 0),
            'messageColor' => $properties['color'] ? $properties['color'] : 'gray.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/github/issues-by-label/{owner}/{repo}/{label}/{states?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
        $route->whereIn('states', ['open', 'closed']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/issues-by-label/nodejs/node/ES%20Modules' => 'issues by label',
            '/github/issues-by-label/atom/atom/help-wanted/open' => 'open issues by label',
            '/github/issues-by-label/rust-lang/rust/B-RFC-approved/closed' => 'closed issues by label',
        ];
    }

    private function getQueryBody(string $label, string $states): string
    {
        $issueFilter = $states ? '(states:['.\mb_strtoupper($states).'])' : '';

        return "label(name:\"{$label}\") { color, issues{$issueFilter} { totalCount } }";
    }
}
