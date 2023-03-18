<?php

declare(strict_types=1);

namespace App\Badges\Maven;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $repo, string $path): string
    {
        if ($repo === 'maven-central') {
            return $this->maven($path);
        }

        return $this->jcenter($path);
    }

    private function maven(string $path): string
    {
        return Http::baseUrl('https://repo1.maven.org/maven2/')->throw()->get($path)->body();
    }

    private function jcenter(string $path): string
    {
        return Http::baseUrl('https://jcenter.bintray.com/')->throw()->get($path)->body();
    }
}
