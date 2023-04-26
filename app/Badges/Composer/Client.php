<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use App\Actions\GetFileFromBitbucket;
use App\Actions\GetFileFromGitHub;
use App\Actions\GetFileFromGitLab;

final class Client
{
    public function get(string $service, string $owner, string $repo): array
    {
        return match ($service) {
            'bitbucket' => GetFileFromBitbucket::json($owner, $repo, 'composer.json'),
            'github' => GetFileFromGitHub::json($owner, $repo, 'composer.json'),
            'gitlab' => GetFileFromGitLab::json($owner, $repo, 'composer.json'),
        };
    }
}
