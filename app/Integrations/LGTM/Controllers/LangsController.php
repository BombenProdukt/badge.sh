<?php

declare(strict_types=1);

namespace App\Integrations\LGTM\Controllers;

use App\Integrations\LGTM\Client;
use Illuminate\Routing\Controller;

final class LangsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $provider, string $owner, string $name, ?string $language = null): array
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
