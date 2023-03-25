<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class IssueBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jira/issue/{issue}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $issue): array
    {
        $response = $this->client->issue($this->getRequestData('instance'), $issue);

        return [
            'issue' => $issue,
            'name' => $response['name'],
            'colorName' => $response['statusCategory']['colorName'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText($properties['label'], \mb_strtolower($properties['name']), match ($properties['colorName']) {
            'medium-gray' => 'gray.600',
            'green' => 'green.600',
            'yellow' => 'yellow.600',
            'brown' => 'orange.600',
            'warm-red' => 'red.600',
            'blue-gray' => 'blue.600',
            default => 'gray.600',
        });
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
            '/jira/issue/KAFKA-2896?instance=https://issues.apache.org/jira' => 'issue',
        ];
    }
}
