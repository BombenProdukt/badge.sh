<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket;

use GrahamCampbell\Bitbucket\Facades\Bitbucket;

final class Client
{
    private \Bitbucket\Client $client;

    public function __construct()
    {
        $this->client = Bitbucket::connection();
    }

    public function pipelines(string $user, string $repo, ?string $branch = null): array
    {
        return $this->client->repositories()->workspaces($user)->pipelines($repo)->list([
            'fields' => 'values.state',
            'page' => 1,
            'pagelen' => 2,
            'sort' => '-created_on',
            'target.ref_type' => 'BRANCH',
            'target.ref_name' => $branch,
        ])['values'];
    }

    public function issues(string $user, string $repo): int
    {
        return $this->client->repositories()->workspaces($user)->issues($repo)->list([
            'limit' => 0,
            'q' => '(state = "new" OR state = "open")',
        ])['size'];
    }

    public function pullRequests(string $user, string $repo): int
    {
        return $this->client->repositories()->workspaces($user)->pullRequests($repo)->list([
            'limit' => 0,
            'state' => 'OPEN',
        ])['size'];
    }
}
