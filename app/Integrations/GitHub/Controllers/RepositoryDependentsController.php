<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Actions\RequestDependents;

final class RepositoryDependentsController extends AbstractController
{
    protected function handleRequest(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'REPOSITORY');
    }
}
