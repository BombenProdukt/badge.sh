<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jira\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class IssueBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $issue): array
    {
        $response = $this->client->issue($this->getRequestData('instance'), $issue);

        return $this->renderText($issue, strtolower($response['name']), match ($response['statusCategory']['colorName']) {
            'medium-gray' => 'gray.600',
            'green'       => 'green.600',
            'yellow'      => 'yellow.600',
            'brown'       => 'orange.600',
            'warm-red'    => 'red.600',
            'blue-gray'   => 'blue.600',
            default       => 'gray.600',
        });
    }

    public function service(): string
    {
        return 'Jira';
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/jira/issue/{issue}',
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
            '/jira/issue/KAFKA-2896?instance=https://issues.apache.org/jira' => 'issue',
        ];
    }
}
