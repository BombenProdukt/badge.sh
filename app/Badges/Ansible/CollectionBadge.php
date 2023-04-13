<?php

declare(strict_types=1);

namespace App\Badges\Ansible;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CollectionBadge extends AbstractBadge
{
    protected string $route = '/ansible/collection/{collectionId}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'collection',
                path: '/ansible/collection/278',
                data: $this->render(['name' => 'community.general']),
            ),
        ];
    }
}
