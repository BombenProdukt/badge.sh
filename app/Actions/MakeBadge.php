<?php

declare(strict_types=1);

namespace App\Actions;

use App\Badger\IconFactory;
use App\Contracts\Badge;
use BombenProdukt\Badger\Badger;
use Illuminate\Http\Request;

final class MakeBadge
{
    public static function execute(Request $request, Badge $badge): Badger
    {
        if ($badge->deprecated()) {
            $badge = Badger::from([
                'label' => $request->segment(1),
                'message' => 'deprecated',
                'messageColor' => 'red.600',
            ]);
        } else {
            $badge = Badger::from($badge->render($badge->handle(...$request->route()->parameters())));
        }

        $badge->withStyle($request->query('style', 'classic'));

        if ($request->has('hideLabel')) {
            $badge->withLabel('');
        }

        if ($request->has('icon')) {
            $badge->withIcon('data:image/svg+xml;base64,'.IconFactory::render($request->query('icon')));
        }

        return $badge;
    }
}
