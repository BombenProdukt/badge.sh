<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\CPAN\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $distribution): array
    {
        $version = $this->normalizeVersion($this->client->get("release/{$distribution}")['version']);

        return [
            'label'        => 'cpan',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }

    private function normalizeVersion(string $version): string
    {
        $version = str_replace('_', '', $version);
        if (! $version || str_starts_with($version, 'v')) {
            return $version;
        }
        [$major, $rest] = explode('.', $version, 2);
        $minor          = substr($rest, 0, 3);
        $patch          = str_pad(substr($rest, 3), 3, '0', STR_PAD_RIGHT);

        return implode('.', array_map('intval', [$major, $minor, $patch]));
    }
}
