<?php

declare(strict_types=1);

namespace App\Integrations\NuGet\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\NuGet\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package, ?string $channel = null): array
    {
        $versions = $this->client->get($package)['versions'];

        if ($channel === 'latest') {
            $version = $this->latest($versions);
        }

        if ($channel === 'pre') {
            $version = $this->latest($this->pre($versions));
        }

        if (empty($channel)) {
            $version = $this->latest($this->stable($versions));
        }

        return [
            'label'       => 'nuget',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }

    private function pre(array $versions): array
    {
        return array_filter($versions, fn ($v) => strpos($v, '-') !== false);
    }

    private function stable(array $versions): array
    {
        return array_filter($versions, fn ($v) => strpos($v, '-') === false);
    }

    private function latest(array $versions): string|null
    {
        return count($versions) > 0 ? end($versions) : null;
    }
}
