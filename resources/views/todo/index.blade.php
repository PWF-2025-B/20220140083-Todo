<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <x-create-button href="{{ route('todo.create') }}" />
                            </div>
                            <div>
                                @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">
                                    {{ session('success') }}
                                </p>
                                @endif

                                @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">
                                    {{ session('danger') }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-black uppercase bg-gray-950 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                {{-- Category --}}
                                <td scope="row" class="px-6 py-4 font-medium text-black dark:text-gray-900">
                                    <a href="{{ route('todo.edit', $data) }}" class="hover:underline text-xs">
                                        {{ $data->title }}
                                    </a>
                                </td>
                                {{-- Category --}}
                                <td class="px-6 py-4">
                                    {{ optional($data->category)->title }}
                                </td>
                                {{-- Status --}}
                                <td class="px-6 py-4 md:block">
                                    @if (!$data->is_done)
                                    <span class="inline-block bg-blue-600 text-black text-xs font-semibold px-3 py-1 rounded-full dark:bg-blue-500">
                                        Ongoing
                                    </span>
                                    @else
                                    <span class="inline-block bg-green-600 text-black text-xs font-semibold px-3 py-1 rounded-full dark:bg-green-500">
                                        Completed
                                    </span>
                                    @endif
                                </td>
                                {{-- Action Buttons --}}
                                <td class="px-6 py-4 space-x-2">
                                    <div class="flex items-center gap-2">
                                        @if (!$data->is_done)
                                        <form action="{{ route('todo.complete', $data) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-black bg-green-700 hover:bg-green-800 focus:ring-4 
    focus:outline-none focus:ring-green-300 font-medium rounded-lg px-2.5 
    py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 
    dark:focus:ring-green-800">
                                                Complete
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('todo.uncomplete', $data) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-black bg-red-700 hover:bg-red-800 focus:ring-4 
    focus:outline-none focus:ring-red-300 font-medium rounded-lg px-2.5 
    py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 
    dark:focus:ring-red-800">
                                                Uncomplete
                                            </button>

                                        </form>
                                        @endif
                                        <form action="{{ route('todo.destroy', $data) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 whitespace-nowrap hover:underline ms-2">

                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No data available
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($todosCompleted > 1)
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button>
                            Delete All Completed Task
                        </x-primary-button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>