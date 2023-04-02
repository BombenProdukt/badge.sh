<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use App\Actions\GetFileFromGitHub;

final class Client
{
    public function github(string $owner, string $repo): array
    {
        return GetFileFromGitHub::json($owner, $repo, 'composer.json');
    }
}
