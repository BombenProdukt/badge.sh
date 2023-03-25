<?php

declare(strict_types=1);

namespace App\Badges\Endpoint\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

final class XMLBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/endpoint/xml',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(): array
    {
        return Validator::make(
            (array) \simplexml_load_string(Http::get($this->getRequestData('url'))->throw()->body()),
            [
                'schemaVersion' => ['required', 'in:1'],
                'label' => ['required', 'string'],
                'labelColor' => ['nullable', 'string'],
                'message' => ['required', 'string'],
                'messageColor' => ['required', 'string'],
                'style' => ['nullable', 'string'],
                'icon' => ['nullable', 'string'],
                'iconWidth' => ['nullable', 'integer'],
                'scale' => ['nullable', 'integer'],
            ],
        )->validate();
    }

    public function render(array $properties): array
    {
        return $properties;
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
            '/endpoint/xml?url'.route('services.endpoint.xml') => 'endpoint with XML',
        ];
    }
}
