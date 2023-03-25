<?php

declare(strict_types=1);

namespace App\Badges\VCPKG;

use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    public function get(string $packageName): array
    {
        return \json_decode(\base64_decode(GitHub::repos()->contents()->show('microsoft', 'vcpkg', "ports/{$packageName}/vcpkg.json")['content'], true), true, \JSON_THROW_ON_ERROR);
    }
}
