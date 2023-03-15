<?php

declare(strict_types=1);

namespace App\Integrations\Mastodon\Controllers;

use App\Integrations\Mastodon\Client;
use Illuminate\Routing\Controller;

final class AccountController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $account): array
    {
        [$username, $instance] = explode('@', $account);
        $version               = $this->client->get($instance, 'instance')['version'];

        if (preg_match('/\bPleroma\b/i', $version) !== 0) {
            return (new UserIdController($this->client))($username, $instance);
        }

        $userId = $this->parseFeed($this->client->rss($instance, $username));

        if (is_string($userId)) {
            return (new UserIdController($this->client))($userId, $instance);
        }

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }

    private function parseFeed(string $feed): ?string
    {
        if (preg_match('/\/accounts\/avatars\/(\d{3})\/(\d{3})\/(\d{3})/', $feed, $matches)) {
            return implode('', array_slice($matches, 1));
        }

        return null;
    }
}
