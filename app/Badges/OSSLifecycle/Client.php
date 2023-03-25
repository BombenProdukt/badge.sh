<?php

declare(strict_types=1);

namespace App\Badges\OSSLifecycle;

use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    public function get(string $user, string $repo, ?string $branch): string
    {
        return \base64_decode(GitHub::repos()->contents()->show($user, $repo, 'OSSMETADATA')['content'], true);
    }
}
