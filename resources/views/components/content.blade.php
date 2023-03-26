<table class="min-w-full divide-y divide-gray-100 my-16">
    <thead>
        <tr>
            <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-bold text-gray-900 sm:pl-0">Service</th>
            <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900">Descriptor</th>
            <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900">Preview</th>
            <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900"></th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-100 bg-white">
        @foreach (app('badge.service')->previews() as $group => $examples)
            @foreach ($examples as $example)
                <tr>
                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-gray-500 sm:pl-0">
                        {{ $group }}
                    </td>
                    <td class="whitespace-nowrap px-2 py-2 font-semibold text-gray-900">
                        {{ $example->name }}
                    </td>
                    <td class="whitespace-nowrap px-2 py-2 text-gray-900">
                        <a href="{{ $example->path }}" target="_blank">
                            <x-badge :badge="$example" />
                        </a>
                    </td>
                    <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right font-medium sm:pr-0">
                        <a href="#" class="text-teal-400 transition font-bold hover:text-teal-900">
                            Customize
                        </a>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
