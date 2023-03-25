<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/size/{scope}/{name}/{tag?}/{architecture?}/{variant?}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        $response = $this->client->tags($scope, $name);

        $results = $response['results'];

        while ($response['next']) {
            $response = Http::get($response['next'])->json();
            $results = \array_merge($results, $response['results']);
        }

        $tagData = null;

        foreach ($results as $data) {
            if ($data['name'] === $tag) {
                $tagData = $data;

                break;
            }
        }

        if (!$tagData) {
            return [
                'size' => 'unknown tag',
            ];
        }

        $imageData = null;

        foreach ($tagData['images'] as $image) {
            if ($image['architecture'] === $architecture) {
                $imageData = $image;

                break;
            }
        }

        if (!$imageData) {
            return [
                'size' => 'unknown architecture',
            ];
        }

        if ($variant) {
            $imageData = null;

            foreach ($tagData['images'] as $image) {
                if ($image['architecture'] === $architecture && $image['variant'] === $variant) {
                    $imageData = $image;

                    break;
                }
            }

            if (!$imageData) {
                return [
                    'size' => 'unknown variant',
                ];
            }
        }

        return [
            'size' => $imageData['size'],
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['size'] === 'unknown tag') {
            return [
                'label' => 'docker',
                'message' => 'unknown tag',
                'messageColor' => 'gray.600',
            ];
        }

        if ($properties['size'] === 'unknown architecture') {
            return [
                'label' => 'docker',
                'message' => 'unknown architecture',
                'messageColor' => 'gray.600',
            ];
        }

        if ($properties['size'] === 'unknown variant') {
            return [
                'label' => 'docker',
                'message' => 'unknown variant',
                'messageColor' => 'gray.600',
            ];
        }

        $sizeInMegabytes = \number_format($properties['size'] / 1024 / 1024, 2);

        return [
            'label' => 'docker size',
            'message' => $sizeInMegabytes.' MB',
            'messageColor' => 'blue.600',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/docker/size/library/ubuntu' => 'size (library)',
            '/docker/size/lukechilds/bitcoind/latest/amd64' => 'size (scoped/tag/architecture)',
            '/docker/size/lucashalbert/curl/latest/arm/v6' => 'size (scoped/tag/architecture/variant)',
        ];
    }
}
