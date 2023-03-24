<?php

declare(strict_types=1);

namespace App\Badges\Endpoint\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

final class JSONBadge extends AbstractBadge
{
    public function handle(): array
    {
        return Validator::make(
            Http::get($this->getRequestData('url'))->throw()->json(),
            [
                'schemaVersion' => ['required', 'in:1'],
                'label'         => ['required', 'string'],
                'labelColor'    => ['nullable', 'string'],
                'message'       => ['required', 'string'],
                'messageColor'  => ['required', 'string'],
                'style'         => ['nullable', 'string'],
                'icon'          => ['nullable', 'string'],
                'iconWidth'     => ['nullable', 'integer'],
                'scale'         => ['nullable', 'integer'],
            ]
        )->validate();
    }

    public function render(array $properties): array
    {
        return $properties;
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/endpoint/json',
        ];
    }

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/endpoint/json?url'.route('services.endpoint.json') => 'endpoint with JSON',
        ];
    }
}
