<?php

declare(strict_types=1);

namespace App\Badges\Bugzilla\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bugzilla/status/{bug}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $bug): array
    {
        $response = $this->client->get($bug);

        return [
            'bug' => $bug,
            'status' => \mb_strtolower($response['status'] === 'RESOLVED' ? $response['resolution'] : $response['status']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText(
            'bug '.$properties['bug'],
            match ($properties['status']) {
                'worksforme' => 'works for me',
                'wontfix' => "won't fix",
                default => $properties['status'],
            },
            match ($properties['status']) {
                'unconfirmed' => 'blue.600',
                'new' => 'blue.600',
                'assigned' => 'green.600',
                'fixed' => 'emerald.600',
                'invalid' => 'yellow.600',
                'wontfix' => 'orange.600',
                'duplicate' => 'slate.600',
                'worksforme' => 'lime.600',
                'incomplete' => 'red.600',
                default => 'gray.600',
            },
        );
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
            '/bugzilla/status/996038' => 'status',
        ];
    }
}
