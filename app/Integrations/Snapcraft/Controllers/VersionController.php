<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Snapcraft\Client;
use Illuminate\Support\Arr;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $response = $this->client->get($snap, ['version']);
        $channel  = collect($response['channel-map'])->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel);

        return [
            'label'        => 'snap',
            'status'       => ExtractVersion::execute($channel['version']),
            'statusColor'  => ExtractVersionColor::execute($channel['version']),
        ];
    }
}
