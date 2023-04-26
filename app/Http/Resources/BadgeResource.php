<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class BadgeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return \array_filter([
            'service' => $this->resource->service(),
            'title' => $this->resource->title(),
            'keywords' => $this->resource->keywords(),
            'routePath' => $this->resource->routePath(),
            'routeRules' => $this->resource->routeRules(),
            'previews' => $this->resource->previews(),
            'deprecated' => $this->resource->deprecated(),
        ]);
    }
}
