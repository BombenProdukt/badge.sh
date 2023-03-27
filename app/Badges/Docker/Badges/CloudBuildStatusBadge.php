<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CloudBuildStatusBadge extends AbstractBadge
{
    protected string $route = '/docker/cloud-build/{scope}/{name}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $scope, string $name): array
    {
        return $this->client->build($scope, $name);
    }

    public function render(array $properties): array
    {
        if ($properties['state'] === 'Success') {
            return $this->renderText('docker build', 'passing', 'green.600');
        }

        if ($properties['state'] === 'Failed') {
            return $this->renderText('docker build', 'failing', 'red.600');
        }

        return $this->renderText('docker build', 'building', 'blue.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build',
                path: '/docker/cloud-build/jrottenberg/ffmpeg',
                data: $this->render(['state' => 'success']),
            ),
        ];
    }
}
