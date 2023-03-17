<?php

declare(strict_types=1);

namespace App\Integrations;

use BladeUI\Icons\Factory;
use Iconify\IconsJSON\Finder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PreemStudio\Badger\Badger;
use Throwable;

abstract class AbstractController extends Controller
{
    public function __invoke(Request $request): Response
    {
        try {
            $badge = Badger::from($this->handleRequest(...$request->route()->parameters()));
            $badge->withStyle($request->query('style', 'flat'));

            if ($request->has('hideLabel')) {
                $badge->withLabel('');
            }

            if ($request->has('icon')) {
                $icon = $request->query('icon');

                if (str_starts_with($icon, 'heroicon')) {
                    $icon = app(Factory::class)->svg($icon)->contents();
                    $icon = str_replace('stroke="currentColor"', 'stroke="#fff"', $icon);
                    $icon = base64_encode($icon);
                }

                if (str_starts_with($icon, 'iconify')) {
                    [,$set,$name] = explode('-', $icon, 3);

                    $icon = json_decode(file_get_contents(Finder::locate($set)), true, JSON_THROW_ON_ERROR)['icons'][$name]['body'];
                    $icon = str_replace('fill="currentColor"', 'fill="#fff"', $icon);
                    $icon = base64_encode('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">'.$icon.'</svg>');
                }

                // $badge->withIcon('data:image/svg+xml;base64,'.$icon);
            }
        } catch (Throwable) {
            $badge = Badger::make();
            $badge->withLabel('badger');
            $badge->withLabelColor('slate.900');
            $badge->withStatus('400');
            $badge->withStatusColor('red.600');
            $badge->withStyle($request->query('style', 'flat'));
        }

        return response($badge->render())->header('Content-Type', 'image/svg+xml;charset=base64');
    }
}
