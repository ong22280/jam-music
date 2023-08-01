<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('status')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => Task::STATUS_TODO,
        ]);

        return redirect()->route('tasks.index');
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . Task::STATUS_TODO . ',' . Task::STATUS_IN_PROGRESS . ',' . Task::STATUS_DONE,
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function move(Request $request, Task $task)
    {
        $this->validate($request, [
            'status' => 'required|in:' . Task::STATUS_TODO . ',' . Task::STATUS_IN_PROGRESS . ',' . Task::STATUS_DONE,
        ]);

        $task->update($request->only('status'));
        return redirect()->route('tasks.index');
    }
}
