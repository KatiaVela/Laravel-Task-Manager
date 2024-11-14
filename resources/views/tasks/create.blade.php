<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-md font-medium text-white">Titulli</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-md font-medium text-white">Pershkrimi</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="block text-md font-medium text-white">Prioriteti</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                <option value="1">I Larte</option>
                                <option value="2">Mesatar</option>
                                <option value="3">I Ulet</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary border-2 p-3 rounded-full">Shto Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
