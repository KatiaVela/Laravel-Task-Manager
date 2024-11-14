<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                @if (session('success'))
                    <div class="alert alert-success p-6 text-gray-900 dark:text-gray-100">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-info p-6 text-gray-900 dark:text-gray-100">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger p-6 text-white border-2">
                        {{ session('error') }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-center text-gray-100">To-Do List</h1>

                <form method="GET" action="{{ route('dashboard') }}" class="d-flex justify-content-center gap-3 mb-4 m-3">
                    <select name="status" class="form-select form-select-sm bg-dark text-light border-light" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Te gjitha</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Jo e perfunduar</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>E perfunduar</option>
                    </select>

                    <select name="priority" class="form-select form-select-sm bg-dark text-light border-light" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Te gjitha prioritetet</option>
                        <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>I Larte</option>
                        <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Mesatar</option>
                        <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>I Ulet</option>
                    </select>
                </form>

                <div class="table-responsive mx-auto w-full max-w-6xl">
                    <table class="table table-hover table-dark table-striped text-center align-middle border-4 ">
                        <thead class="thead-light border-4">
                            <tr>
                                <th class="px-4 text-white text-xl">Titulli</th>
                                <th class="px-4 text-white text-xl">Pershkrimi</th>
                                <th class="px-4 text-white text-xl">Data e Krijimit</th>
                                <th class="px-4 text-white text-xl">Statusi</th>
                                <th class="px-4 text-white text-xl">Prioriteti</th>
                                <th class="px-4 text-white text-xl">Veprime</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="border-2">
                                    <td class="text-white border-2 px-3">{{ $task->title }}</td>
                                    <td class="text-white border-2 px-3">{{ $task->description }}</td>
                                    <td class="text-white border-2 px-3">{{ $task->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="text-white border-2 px-3">
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="checkbox" name="status" onchange="this.form.submit()" {{ $task->status ? 'checked' : '' }}>
                                        </form>
                                    </td>
                                    <td class="text-white border-2">
                                        <span class="badge
                                            {{ $task->priority == 1 ? 'bg-danger' : ($task->priority == 2 ? 'bg-info text-dark' : 'bg-secondary') }}">
                                            {{ $task->priority == 1 ? 'Larte' : ($task->priority == 2 ? 'Mesatar' : 'I ulet') }}
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-center gap-2 p-2">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn bg-green  border-2 rounded-full p-2  text-white btn-sm">Edito</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger border-2 rounded-full bg-white btn-sm p-2">Fshi</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center m-4 my-5">
                    <a href="{{ route('tasks.create') }}" class="btn px-6 py-3 border-2 border-white rounded-full bg-white text-gray-800 text-md hover:bg-gray-100 hover:border-gray-300 transition-all duration-300">+ Add Task</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
