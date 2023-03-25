<?php

declare(strict_types=1);

namespace App\Badges\Endpoint\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

final class XMLBadge extends AbstractBadge
{
    protected array $routes = [
        '/endpoint/xml',
    ];

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

    public function routeRules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'endpoint with XML',
                path: '/endpoint/xml?url'.route('services.endpoint.xml'),
                data: $this->render([
                    'label' => 'XML',
                    'message' => 'OK',
                    'messageColor' => 'green.600',
                ]),
            ),
        ];
    }
}
