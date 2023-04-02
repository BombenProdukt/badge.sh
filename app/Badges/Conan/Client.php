<?php

declare(strict_types=1);

namespace App\Badges\Conan;

use App\Actions\GetFileFromGitHub;

final class Client
{
    public function get(string $packageName): array
    {
        return GetFileFromGitHub::yaml('conan-io', 'conan-center-index', "recipes/{$packageName}/config.yml");
    }
}
