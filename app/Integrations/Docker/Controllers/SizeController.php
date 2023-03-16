<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\Docker\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class SizeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(
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
            $results  = array_merge($results, $response['results']);
        }

        $tagData = null;
        foreach ($results as $data) {
            if ($data['name'] === $tag) {
                $tagData = $data;
                break;
            }
        }

        if (! $tagData) {
            return [
                'label'       => 'docker',
                'status'      => 'unknown tag',
                'statusColor' => 'gray.600',
            ];
        }

        $imageData = null;
        foreach ($tagData['images'] as $image) {
            if ($image['architecture'] === $architecture) {
                $imageData = $image;
                break;
            }
        }

        if (! $imageData) {
            return [
                'label'       => 'docker',
                'status'      => 'unknown architecture',
                'statusColor' => 'gray.600',
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

            if (! $imageData) {
                return [
                    'label'       => 'docker',
                    'status'      => 'unknown variant',
                    'statusColor' => 'gray.600',
                ];
            }
        }

        $sizeInMegabytes = number_format($imageData['size'] / 1024 / 1024, 2);

        return [
            'label'       => 'docker size',
            'status'      => $sizeInMegabytes.' MB',
            'statusColor' => 'blue.600',
        ];
    }
}
