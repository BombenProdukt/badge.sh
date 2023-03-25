<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LabelsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/issues-by-label/{repo}/{label}/{state?}',
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitlab/issues-by-label/NickBusey/HomelabOS/Bug' => 'issues by label',
            '/gitlab/issues-by-label/NickBusey/HomelabOS/Enhancement/opened' => 'open issues by label',
            '/gitlab/issues-by-label/NickBusey/HomelabOS/Help%20wanted/closed' => 'closed issues by label',
        ];
    }
}
