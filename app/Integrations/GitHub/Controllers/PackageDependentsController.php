<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Actions\RequestDependents;
use App\Integrations\GitHub\Client;

final class PackageDependentsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'PACKAGE');
    }
}
