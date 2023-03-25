<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Enums\Category;

final class SprintBadge extends AbstractBadge
{
    protected array $routes = [
        '/jira/sprint/{sprint}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $sprint): array
    {
        $response = $this->client->sprint($this->getRequestData('instance'), $sprint);
        $numTotalIssues = $response['total'];
        $numCompletedIssues = collect($response['issues'])->filter(fn ($issue) => $issue['fields']['resolution']['name'] !== 'Unresolved')->count();

        return [
            'percentage' => $numTotalIssues > 0 ? ($numCompletedIssues / $numTotalIssues) * 100 : 0,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('completion', $properties['percentage']);
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            '/jira/sprint/94?instance=https://jira.spring.io' => 'sprint',
        ];
    }
}
