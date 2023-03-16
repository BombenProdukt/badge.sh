<?php

declare(strict_types=1);

namespace App\Integrations\Maven\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Maven\Client;
use Illuminate\Routing\Controller;

final class RepoController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $repo, string $group, string $artifact): array
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
