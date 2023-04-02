<?php

declare(strict_types=1);

namespace App\Badges\VCPKG;

use App\Actions\GetFileFromGitHub;

final class Client
{
    public function get(string $packageName): array
    {
        return GetFileFromGitHub::json('microsoft', 'vcpkg', "ports/{$packageName}/vcpkg.json");
    }
}
