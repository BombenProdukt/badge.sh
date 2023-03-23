<?php

declare(strict_types=1);

namespace App\Badges\W3C\Badges;

use App\Badges\AbstractBadge;
use App\Badges\W3C\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(): array
    {
        $errors = collect($this->client->get($this->getRequestData('url'))['messages'])
            ->filter(fn ($message) => in_array($message['type'], ['error', 'warning']))
            ->count();

        return $this->renderStatus('w3c', $errors ? 'failed' : 'passed');
    }

    public function service(): string
    {
        return 'W3C Validation';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/w3c/status',
        ];
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/w3c/status?url=https://youtube.com/' => 'status',
        ];
    }
}
