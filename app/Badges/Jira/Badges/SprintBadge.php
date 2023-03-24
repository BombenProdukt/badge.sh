<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SprintBadge extends AbstractBadge
{
    public function handle(string $sprint): array
    {
        $response           = $this->client->sprint($this->getRequestData('instance'), $sprint);
        $numTotalIssues     = $response['total'];
        $numCompletedIssues = collect($response['issues'])->filter(fn ($issue) => $issue['fields']['resolution']['name'] !== 'Unresolved')->count();

        return $this->renderPercentage('completion', $numTotalIssues > 0 ? ($numCompletedIssues / $numTotalIssues) * 100 : 0);
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/jira/sprint/{sprint}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
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
            '/jira/sprint/94?instance=https://jira.spring.io' => 'sprint',
        ];
    }
}
