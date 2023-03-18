<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Actions\FormatNumber;
use App\Badges\ChromeWebStore\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class UsersBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $itemId): array
    {
        preg_match('|<span class="e-f-ih" title="(.*?)">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'label'       => 'rating',
            'status'      => FormatNumber::execute((int) filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT)),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Chrome Web Store';
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
            '/chrome-web-store/users/{itemId}',
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
            '/chrome-web-store/users/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'users',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
