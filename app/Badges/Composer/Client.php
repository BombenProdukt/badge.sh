<?php

declare(strict_types=1);

namespace App\Badges\Composer;

use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    public function github(string $owner, string $repo): array
    {
        return \json_decode(\base64_decode(GitHub::repos()->contents()->show($owner, $repo, 'composer.json')['content'], true), true, \JSON_THROW_ON_ERROR);
    }
}
