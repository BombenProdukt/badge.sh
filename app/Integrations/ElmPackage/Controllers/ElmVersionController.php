<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\ElmPackage\Client;

final class ElmVersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $name): array
    {
        $version = $this->formatElmVersion($this->client->get($owner, $name)['elm-version']);

        return [
            'label'        => 'elm',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }

    private function formatElmVersion(string $range): string
    {
        $parts = preg_split('/\s+/', $range);
        $parts = array_filter($parts, fn ($it) => $it !== 'v');

        if (count($parts) === 1) {
            return $parts[0];
        }

        [$lower, $lowerOp, $upperOp, $upper] = array_values($parts);
        $lowerOp                             = preg_replace('/^</', '>', $lowerOp);

        return "{$lowerOp}{$lower} {$upperOp}{$upper}";
    }
}
