<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard of Antivirus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="container mx-auto">
                        <div class="bg-red-600 text-white text-lg font-bold p-4 rounded-t-lg shadow-md text-center">
                            Top 5 Failed Logins
                        </div>
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-b-lg shadow-md">
                            <table class="w-full min-w-full border border-gray-300 dark:border-gray-600">
                                <thead class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th class="py-3 px-6 border-b">Username</th>
                                        <th class="py-3 px-6 border-b">Event Type</th>
                                        <th class="py-3 px-6 border-b">Count</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @foreach($topFailedLogins as $login)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                            <td class="py-4 px-6 border-b">{{ $login->username }}</td>
                                            <td class="py-4 px-6 border-b">{{ $login->event_type }}</td>
                                            <td class="py-4 px-6 border-b">{{ $login->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
