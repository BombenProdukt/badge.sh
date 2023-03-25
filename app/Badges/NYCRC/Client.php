<?php

declare(strict_types=1);

namespace App\Badges\NYCRC;

use GrahamCampbell\GitHub\Facades\GitHub;

// @todo: .nycrc.json
// @todo: .nycrc.yaml
// @todo: .nycrc.yml
// @todo: package.json
final class Client
{
    public function get(string $user, string $repo)
    {
        return \json_decode(\base64_decode(GitHub::repos()->contents()->show($user, $repo, '.nycrc')['content'], true), true, \JSON_THROW_ON_ERROR);
    }
}
