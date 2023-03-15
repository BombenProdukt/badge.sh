<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Actions\RequestDependents;
use Illuminate\Routing\Controller;

final class RepositoryDependentsController extends Controller
{
    public function __invoke(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'REPOSITORY');
    }
}
