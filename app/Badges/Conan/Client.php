<?php

declare(strict_types=1);

namespace App\Badges\Conan;

use GrahamCampbell\GitHub\Facades\GitHub;
use Symfony\Component\Yaml\Yaml;

final class Client
{
    public function get(string $packageName): array
    {
        return Yaml::parse(base64_decode(GitHub::repos()->contents()->show('conan-io', 'conan-center-index', "recipes/{$packageName}/config.yml")['content']));
    }
}
