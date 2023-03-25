<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CollectionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ansible/collection/{collectionId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $collectionId): array
    {
        $response = $this->client->collections($collectionId);

        return [
            'name' => $response['namespace']['name'].'.'.$response['name'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('collection', $properties['name'], 'blue.600');
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
            '/ansible/collection/278' => 'collection',
        ];
    }
}
