<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Badges\AbstractBadge;
use BackedEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use PreemStudio\Badger\Badger;
use Throwable;

final class BadgeList extends Component
{
    public ?string $query = '';

    public ?string $category = '';

    public ?array $selectedBadge = null;

    public function render(): View
    {
        $badges = [];

        foreach ($this->badges as $index => $badge) {
            $badges[$badge->service()] ??= [];

            foreach ($badge->previews() as $preview) {
                $badges[$badge->service()][] = [
                    'index' => $index,
                    'preview' => $preview,
                ];
            }
        }

        return view('livewire.badge-list', [
            'badges' => $badges,
        ]);
    }

    public function getBadgesProperty(): Collection
    {
        $badges = collect(app('badge.service')->all());

        if ($this->query) {
            $badges = $badges->filter(function ($badge) {
                $matchesService = \str_contains(\mb_strtolower($badge->service()), $this->query);
                $matchesTitle = \str_contains(\mb_strtolower($badge->title()), $this->query);
                $matchesKeyword = collect($badge->keywords())->contains(fn (BackedEnum $keyword) => \str_contains($keyword->value, $this->query));

                return $matchesService || $matchesTitle || $matchesKeyword;
            });
        }

        if ($this->category) {
            $badges = $badges->filter(function ($badge) {
                return collect($badge->keywords())->contains(fn (BackedEnum $keyword) => $keyword->value === $this->category);
            });
        }

        return $badges;
    }

    public function customizeBadge(int $index): void
    {
        /** @var AbstractBadge */
        $this->selectedBadge['index'] = $index;

        $selectedBadge = $this->getBadge();
        $selectedBadge->setRequest(request());

        $this->selectedBadge['pathPattern'] = $selectedBadge->routeSchema()['path'];
        $this->selectedBadge['path'] = url($selectedBadge->routeSchema()['path']);
        $this->selectedBadge['query'] = \array_fill_keys(\array_keys($selectedBadge->routeRules()), null);
        $this->selectedBadge['route'] = \array_fill_keys($selectedBadge->routeParameterKeys(), null);
        $this->selectedBadge['overwrites'] = [
            'style' => 'flat',
            'label' => null,
            'labelColor' => null,
            'message' => null,
            'messageColor' => null,
        ];
    }

    public function updatedSelectedBadge($value, $key): void
    {
        if (\is_string($key) && \str_starts_with($key, 'route.')) {
            foreach ($this->selectedBadge['route'] as $routeKey => $routeValue) {
                $this->selectedBadge['path'] = url(\preg_replace('/{'.$routeKey.'}/', $routeValue, $this->selectedBadge['pathPattern']));
            }
        }

        if (\is_string($key) && \str_starts_with($key, 'query.')) {
            $this->selectedBadge['path'] = $this->selectedBadge['pathPattern'].'?'.\http_build_query($this->selectedBadge['query']);
        }
    }

    public function renderBadge()
    {
        if (isset($this->selectedBadge['index'])) {
            try {
                $badge = $this->getBadge();

                $parameters = $badge->render(
                    $badge->handle(
                        ...$this->selectedBadge['query'],
                        ...$this->selectedBadge['route'],
                    ),
                );
            } catch (Throwable) {
                $parameters = [
                    'label' => 'hello',
                    'message' => 'world',
                    'messageColor' => 'green.600',
                ];
            }
        }

        return Badger::from([
            'label' => $this->selectedBadge['overwrites']['label'] ?? $parameters['label'],
            'labelColor' => $this->selectedBadge['overwrites']['labelColor'] ?? 'slate.900',
            'message' => $this->selectedBadge['overwrites']['message'] ?? $parameters['message'],
            'messageColor' => $this->selectedBadge['overwrites']['messageColor'] ?? $parameters['messageColor'],
            'style' => $this->selectedBadge['overwrites']['style'],
        ])->render();
    }

    private function getBadge(): AbstractBadge
    {
        return $this->badges->get($this->selectedBadge['index']);
    }
}
