<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="border px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            Name
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="col"
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                #{{ $permission->id }}
                            </th>
                            <th scope="col"
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $permission->name }}
                            </th>
                        </tr>
                    @empty
                        <td colspan="2"
                            class="border text-center px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            Permission doesn't exist.
                        </td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
