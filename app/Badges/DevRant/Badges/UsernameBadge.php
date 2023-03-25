<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UsernameBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/devrant/score/{username}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $username): array
    {
        return $this->client->get($this->client->getUserIdFromName($username));
    }

    public function render(array $properties): array
    {
        return [
            'label' => \ucfirst($properties['username']),
            'message' => FormatNumber::execute($properties['score']),
            'messageColor' => 'f99a66',
        ];
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
            '/devrant/score/Linuxxx' => 'score',
        ];
    }
}
