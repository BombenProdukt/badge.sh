<?php

declare(strict_types=1);

namespace App\Integrations\LGTM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\LGTM\Client;

final class LangsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $provider, string $owner, string $name, ?string $language = null): array
    {
        $response = $this->client->get($provider, $owner, $name, $language);

        usort($response['languages'], fn ($a, $b) => $b['lines'] - $a['lines']);

        return [
            'label'       => 'languages',
            'status'      => implode(' | ', array_map(fn ($x) => $langLabelOverrides[$x['language']] ?? $x['language'], $response['languages'])),
            'statusColor' => 'blue.600',
        ];
    }
}
