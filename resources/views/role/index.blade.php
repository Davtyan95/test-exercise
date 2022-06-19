<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role list') }}
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
                        <th scope="col" class="border px-6 py-3">
                            Permissions
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($roles as $role)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                #{{ $role->id }}
                            </td>
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $role->name }}
                            </td>
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                @forelse($role->permissions as $permission)
                                    <span
                                        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-400 text-white rounded">{{ $permission->name }}</span>
                                @empty
                                    <span
                                        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded">This role has not permission</span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <td colspan="3"
                            class="border text-center px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            Role doesn't exist.
                        </td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
