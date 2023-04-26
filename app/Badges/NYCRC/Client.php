<?php

declare(strict_types=1);

namespace App\Badges\NYCRC;

use App\Actions\GetFileFromGitHub;

// @todo: .nycrc.json
// @todo: .nycrc.yaml
// @todo: .nycrc.yml
// @todo: package.json
final class Client
{
    public function get(string $user, string $repo)
    {
        return GetFileFromGitHub::json($user, $repo, '.nycrc');
    }
}
