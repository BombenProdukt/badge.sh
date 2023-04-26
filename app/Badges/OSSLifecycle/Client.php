<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle;

use App\Actions\GetFileFromGitHub;

final class Client
{
    public function get(string $user, string $repo, ?string $branch): string
    {
        return GetFileFromGitHub::raw($user, $repo, 'OSSMETADATA');
    }
}
