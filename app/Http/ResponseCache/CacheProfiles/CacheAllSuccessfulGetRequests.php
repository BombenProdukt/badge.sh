<?php

declare(strict_types=1);

namespace App\Http\ResponseCache\CacheProfiles;

use Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests as BaseCacheProfile;
use Symfony\Component\HttpFoundation\Response;

final class CacheAllSuccessfulGetRequests extends BaseCacheProfile
{
    public function hasCacheableContentType(Response $response): bool
    {
        if (parent::hasCacheableContentType($response)) {
            return true;
        }

        return \str_starts_with($response->headers->get('Content-Type', ''), 'image/svg');
    }
}
