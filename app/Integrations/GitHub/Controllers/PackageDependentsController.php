<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Actions\RequestDependents;
use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class PackageDependentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'PACKAGE');
    }
}
