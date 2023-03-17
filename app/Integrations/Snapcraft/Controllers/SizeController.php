<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\Snapcraft\Client;
use Illuminate\Support\Arr;

final class SizeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $response = $this->client->get($snap, ['size']);
        $channel  = collect($response['channel-map'])->firstWhere(fn (array $item) => Arr::get($item, 'channel.architecture') === $architecture && Arr::get($item, 'channel.name') === $channel);

        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($channel['download']['size']),
            'statusColor'  => 'green.600',
        ];
    }
}
