<?php

declare(strict_types=1);

namespace App\Badges\DevRant\Badges;

use App\Badges\DevRant\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UsernameBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $profile = $this->client->get($this->client->getUserIdFromName($username));

        return [
            'label'        => ucfirst($profile['username']),
            'message'      => FormatNumber::execute($profile['score']),
            'messageColor' => 'f99a66',
        ];
    }

    public function service(): string
    {
        return 'devRant';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/devrant/{username}/score',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/devrant/Linuxxx/score' => 'score',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}