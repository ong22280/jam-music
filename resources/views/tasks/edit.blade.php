@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 sm:px-8 py-12">
        <h2 class="text-3xl font-bold mb-8 text-blue-700">Edit Task</h2>
        <form action="{{ route('tasks.update', $task) }}" method="post" class="space-y-6">
            @method('PUT')
            @csrf
            <input type="text" name="title" value="{{ $task->title }}"
                class="w-full px-6 py-4 border-2 border-blue-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-lg">
            <input type="text" name="description" value="{{ $task->description }}"
                class="w-full px-6 py-4 border-2 border-blue-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-lg">
            <select name="status"
                class="w-full px-6 py-4 border-2 border-blue-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-lg">
                <option value="{{ \App\Models\Task::STATUS_TODO }}" {{ $task->status === \App\Models\Task::STATUS_TODO ? 'selected' : '' }}>To
                    Do</option>
                <option value="{{ \App\Models\Task::STATUS_IN_PROGRESS }}"
                    {{ $task->status === \App\Models\Task::STATUS_IN_PROGRESS ? 'selected' : '' }}>In Progress</option>
                <option value="{{ \App\Models\Task::STATUS_DONE }}" {{ $task->status === \App\Models\Task::STATUS_DONE ? 'selected' : '' }}>Done
                </option>
            </select>
            <button type="submit"
                class="w-full px-6 py-4 text-xl font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </form>
    </div>
@endsection
