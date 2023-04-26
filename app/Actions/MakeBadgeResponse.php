<?php

declare(strict_types=1);

namespace App\Actions;

use BombenProdukt\Badger\Badger;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

final class MakeBadgeResponse
{
    public static function execute(Request $request, string $svg): Response
    {
        try {
            return response($svg)
                ->setStatusCode(200)
                ->header('Content-Type', 'image/svg+xml;charset=base64')
                ->setPublic()
                ->setMaxAge(120)
                ->setSharedMaxAge((int) $request->query('s_maxage', 21600))
                ->setStaleWhileRevalidate(86400);
        } catch (Throwable $th) {
            if (app()->environment('local')) {
                dd($th, $request->route()->parameters());
            }

            $badge = Badger::make();
            $badge->withLabel($request->segment(1));
            $badge->withLabelColor('slate.900');
            $badge->withStatus('bad request');
            $badge->withStatusColor('red.600');
            $badge->withStyle($request->query('style', 'classic'));

            return response($badge->render())
                ->setStatusCode(400)
                ->header('Content-Type', 'image/svg+xml;charset=base64')
                ->setPublic()
                ->setMaxAge(60)
                ->setSharedMaxAge(60);
        }
    }
}
