<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\Snapcraft\Client;
use Closure;
use Illuminate\Routing\Controller;

final class SizeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $response = $this->client->get($snap, ['size']);
        $channel  = collect($response['channel-map'])->firstWhere($this->createChannelMatcher($architecture, $channel));

        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($channel['download']['size']),
            'statusColor'  => 'green.600',
        ];
    }

    protected function createChannelMatcher(?string $architecture, ?string $channel): Closure
    {
        $matchArchitecture = $architecture
          ? fn ($channel) => $channel['architecture'] === $architecture
          : fn () => true;

        $matchChannel = $channel
          ? fn ($channel) => $channel['name'] === $channel
          : fn () => true;

        return fn ($it) => $matchArchitecture($it) && $matchChannel($it);
    }
}
