<?php

declare(strict_types=1);

namespace App\Integrations\Maven\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Maven\Client;

final class RepoController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $repo, string $group, string $artifact): array
    {
        $response = $this->client->get($repo, str_replace('.', '/', $group)."/{$artifact}/maven-metadata.xml");

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return [
            'label'       => $repo,
            'status'      => ExtractVersion::execute($matches[1]),
            'statusColor' => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
