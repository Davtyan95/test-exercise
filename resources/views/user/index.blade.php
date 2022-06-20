<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User list') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto sm:rounded-lg">
                <div class="mb-4">
                    <form action="{{ route('user.index') }}" method="post">
                        @method('POST')
                        @csrf
                        <label for="user-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <input type="search" value="{{ $search }}" id="user-search" name="search" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                            <a href="{{ route('user.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Reset filter</a>
                        </div>
                    </form>
                </div>
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
                            Created Date
                        </th>
                        <th scope="col" class="border px-6 py-3">
                            Roles
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                #{{ $user->id }}
                            </td>
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $user->created_at }}
                            </td>
                            <td
                                class="border px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                @forelse($user->roles as $role)
                                    <span
                                        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-400 text-white rounded">{{ $role->name }}</span>
                                @empty
                                    <span
                                        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded">This user has not role</span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <td colspan="3"
                            class="border text-center px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            User doesn't exist.
                        </td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>



