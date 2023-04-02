<div class="mt-16">
    {{-- Search --}}
    <div class="relative mt-2 rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-1 top-1 bottom-1 flex items-center">
            <select wire:model="category" autocomplete="category"
                class="bg-slate-50 h-full rounded-md border-0 py-0 pl-3 pr-7 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                <option value="">All</option>
                @foreach (\App\Enums\Category::cases() as $case)
                    <option value="{{ $case->value }}">{{ Str::title($case->value) }}</option>
                @endforeach
            </select>
        </div>
        <input type="text" wire:model="query"
            class="block w-full rounded-md border-0 py-1.5 pl-40 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Search...">
    </div>

    {{-- Badges --}}
    <table class="min-w-full divide-y divide-gray-100 mt-4">
        <thead>
            <tr class="border-gray-100 border-t">
                <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-bold text-gray-900 sm:pl-0">
                    Service</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900">Descriptor
                </th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900">Preview</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 bg-white">
            @foreach ($badges as $service => $previews)
                @foreach ($previews as $badge)
                    <tr>
                        <td class="whitespace-nowrap py-2 pl-4 pr-3 text-gray-500 sm:pl-0 text-sm">
                            {{ $service }}
                        </td>
                        <td class="whitespace-nowrap px-2 py-2 font-semibold text-gray-900 text-sm">
                            {{ $badge['preview']->name }}
                        </td>
                        <td class="whitespace-nowrap px-2 py-2 text-gray-900">
                            <a href="{{ $badge['preview']->path }}" target="_blank">
                                <x-badge :badge="$badge['preview']" />
                            </a>
                        </td>
                        <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right font-medium sm:pr-0 text-sm">
                            <button type="button" class="text-indigo-600 transition font-bold hover:text-indigo-900"
                                wire:click="customizeBadge({{ $badge['index'] }})">
                                Customize
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    {{-- Customization --}}
    @if ($selectedBadge)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
                        <div>
                            <form>
                                <div class="mb-4">
                                    <input wire:model="selectedBadge.path" type="text"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-gray-50 cursor-not-allowed shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        readonly>

                                    <div class="mt-2 flex justify-center">
                                        {!! $this->renderBadge() !!}
                                    </div>
                                </div>

                                <div
                                    class="mt-4 space-y-8 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
                                    @if ($selectedBadge['route'])
                                        @foreach (array_keys($selectedBadge['route']) as $routeParam)
                                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                                <label for="{{ $routeParam }}"
                                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">{{ Str::title($routeParam) }}</label>
                                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                                    <input type="text"
                                                        wire:model="selectedBadge.route.{{ $routeParam }}"
                                                        id="{{ $routeParam }}"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($selectedBadge['query'])
                                        @foreach (array_keys($selectedBadge['query']) as $queryParam)
                                            <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                                <label for="{{ $queryParam }}"
                                                    class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">{{ Str::title($queryParam) }}</label>
                                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                                    <input type="text"
                                                        wire:model="selectedBadge.query.{{ $queryParam }}"
                                                        id="{{ $queryParam }}"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                        <label for="country"
                                            class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Style</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <select id="country" wire:model="selectedBadge.overwrites.style"
                                                autocomplete="country-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="classic">Classic</option>
                                                <option value="flat">Flat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Label</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <input type="text" wire:model="selectedBadge.overwrites.label"
                                                id="first-name" autocomplete="given-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                        <label for="last-name"
                                            class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Label
                                            Color</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <input type="text" wire:model="selectedBadge.overwrites.labelColor"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                        <label for="first-name"
                                            class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Message</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <input type="text" wire:model="selectedBadge.overwrites.message"
                                                id="first-name" autocomplete="given-name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2">
                                        <label for="last-name"
                                            class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Message
                                            Color</label>
                                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                                            <input type="text" wire:model="selectedBadge.overwrites.messageColor"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 sm:mt-6">
                            <button wire:click="$set('selectedBadge', null)" type="button"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
