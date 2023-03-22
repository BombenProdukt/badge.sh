<?php

declare(strict_types=1);

namespace App\Badges\Ansible\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Ansible\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CollectionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $collectionId): array
    {
        $response = $this->client->collections($collectionId);

        return $this->renderText('collection', $response['namespace']['name'].'.'.$response['name'], 'blue.600');
    }

    public function service(): string
    {
        return 'Ansible';
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/ansible/collection/{collectionId}',
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
            '/ansible/collection/278' => 'collection',
        ];
    }
}
