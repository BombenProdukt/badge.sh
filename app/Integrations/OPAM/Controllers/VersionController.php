<?php

declare(strict_types=1);

namespace App\Integrations\OPAM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\OPAM\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
    {
        preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'label'        => 'opam',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
