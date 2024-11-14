<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    public function dashboard(Request $request)
    {
        $tasks = Task::where('user_id', auth()->id());

        if ($request->has('status') && $request->status !== null) {
            $tasks->where('status', $request->status);
        }

        if ($request->has('priority') && $request->priority !== null) {
            $tasks->where('priority', $request->priority);
        }

        $tasks = $tasks->orderBy('priority', 'asc')->get();

        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|integer',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => false,
            'priority' => $request->priority,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task u shtua me sukses!');
    }

    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->priority, function ($query) use ($request) {
                $query->where('priority', $request->priority);
            })
            ->get();

        return view('dashboard', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|integer',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task u perditesua me sukses!');
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->has('status') ? 1 : 0;
        $task->save();

        return redirect()->route('dashboard')->with('status', 'Statusi i detyres u perditesua!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('dashboard');
        }

        $task->delete();

        return redirect()->route('dashboard');
    }
}