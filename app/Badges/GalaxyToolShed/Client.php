<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://toolshed.g2.bx.psu.edu/api/repositories')->throw();
    }

    public function fetchOrderedInstallableRevisionsSchema(string $user, string $repo): string
    {
        return $this->client->get('get_ordered_installable_revisions', [
            'name' => $repo,
            'owner' => $user,
        ])->json('0');
    }

    public function fetchRepositoryRevisionInstallInfoSchema(string $user, string $repo, string $changesetRevision): array
    {
        return $this->client->get('get_repository_revision_install_info', [
            'name' => $repo,
            'owner' => $user,
            'changeset_revision' => $changesetRevision,
        ])->json('0');
    }

    public function fetchLastOrderedInstallableRevisionsSchema(string $user, string $repo): array
    {
        $changesetRevisions = $this->fetchOrderedInstallableRevisionsSchema($user, $repo);

        return $this->fetchRepositoryRevisionInstallInfoSchema($user, $repo, $changesetRevisions);
    }
}
