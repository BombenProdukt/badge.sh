<?php

declare(strict_types=1);

namespace App\Badges\Docker;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hub.docker.com/v2/repositories/')->throw();
    }

    public function info(string $scope, string $package): array
    {
        return $this->client->get("{$scope}/{$package}")->json();
    }

    public function tags(string $scope, string $package): array
    {
        return $this->client->get("{$scope}/{$package}/tags")->json();
    }

    public function build(string $scope, string $package): array
    {
        return Http::get('https://cloud.docker.com/api/build/v1/source', ['image' => "{$scope}/{$package}"])->json('objects.0');
    }

    public function registry(string $token, string $path): array
    {
        return Http::baseUrl('https://registry.hub.docker.com/v2')
            ->accept('application/vnd.docker.distribution.manifest.list.v2+json')
            ->withToken($token)
            ->throw()
            ->get($path)
            ->json();
    }

    public function config(string $scope, string $name, string $tag, string $architecture, string $variant): array
    {
        $token = $this->getDockerAuthToken($scope, $name);
        $manifests = $this->getManifestList($token, $scope, $name, $tag, $architecture, $variant);
        $manifest = $this->getImageManifest($token, $scope, $name, $manifests['digest']);

        return $this->getImageConfig($token, $scope, $name, $manifest['config']['digest']);
    }

    private function getDockerAuthToken(string $scope, string $name)
    {
        return Http::baseUrl('https://auth.docker.io/')->get('token', [
            'service' => 'registry.docker.io',
            'scope' => "repository:{$scope}/{$name}:pull",
        ])->json('token');
    }

    private function getManifestList(string $token, string $scope, string $name, string $tag, string $architecture, string $variant)
    {
        $manifests = $this->registry($token, "{$scope}/{$name}/manifests/{$tag}")['manifests'];

        if (!$manifests) {
            throw new \Exception("The tag is unknown: {$tag}");
        }

        $manifest = collect($manifests)->firstWhere(fn ($item) => $item['platform']['architecture'] === $architecture);

        if (!$manifest) {
            throw new \Exception("The architecture is unknown: {$architecture}");
        }

        if ($variant) {
            $manifest = collect($manifests)
                ->filter(fn ($item) => $item['platform']['architecture'] === $architecture)
                ->firstWhere('platform.variant', $variant);

            if (!$manifest) {
                throw new \Exception("The variant is unknown: {$variant}");
            }
        }

        if (!$manifest['digest']) {
            throw new \Exception("Failed to digest the image: {$scope}/{$name}:{$tag}");
        }

        return $manifest;
    }

    private function getImageManifest(string $token, string $scope, string $name, string $digest)
    {
        return $this->registry($token, "{$scope}/{$name}/manifests/{$digest}");
    }

    private function getImageConfig(string $token, string $scope, string $name, string $digest)
    {
        return $this->registry($token, "{$scope}/{$name}/blobs/{$digest}");
    }
}
