@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8 sm:px-8 sm:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <!-- ...To Do Section... -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold mb-6 text-blue-700">To Do</h2>
                @foreach ($tasks->where('status', \App\Models\Task::STATUS_TODO) as $task)
                    <div class="p-6 bg-blue-100 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-4">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-700 mb-4">{{ $task->description }}</p>
                        <div class="flex justify-between items-center">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-200 rounded">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-red-700 bg-red-200 rounded">Delete</button>
                                </form>
                            </div>
                            <form action="{{ route('tasks.move', $task) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_IN_PROGRESS }}">
                                <button type="submit"
                                    class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Start</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- ...In Progress Section... -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold mb-6 text-orange-700">In Progress</h2>
                @foreach ($tasks->where('status', \App\Models\Task::STATUS_IN_PROGRESS) as $task)
                    <div class="p-6 bg-orange-100 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-4">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-700 mb-4">{{ $task->description }}</p>
                        <div class="flex justify-between items-center">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-200 rounded">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-red-700 bg-red-200 rounded">Delete</button>
                                </form>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <form action="{{ route('tasks.move', $task) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_DONE }}">
                                    <button type="submit"
                                        class="px-4 py-2 w-full sm:w-auto font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Complete</button>
                                </form>
                                <form action="{{ route('tasks.move', $task) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_TODO }}">
                                    <button type="submit"
                                        class="px-4 py-2 w-full sm:w-auto font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Step
                                        Back</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- ...Done Section... -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold mb-6 text-green-700">Done</h2>
                @foreach ($tasks->where('status', \App\Models\Task::STATUS_DONE) as $task)
                    <div class="p-6 bg-green-100 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-4">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-700 mb-4">{{ $task->description }}</p>
                        <div class="flex justify-between items-center">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="px-4 py-2 text-sm font-medium text-blue-700 bg-blue-200 rounded">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-red-700 bg-red-200 rounded">Delete</button>
                                </form>
                            </div>
                            <form action="{{ route('tasks.move', $task) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="status" value="{{ \App\Models\Task::STATUS_IN_PROGRESS }}">
                                <button type="submit"
                                    class="px-4 py-2 font-medium text-white bg-orange-600 rounded-md hover:bg-orange-700">Step
                                    Back</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Add New Task section -->
        <div class="mt-8 sm:mt-16">
            <h2 class="text-3xl font-bold mb-6 text-gray-900">Add New Task</h2>
            <form action="{{ route('tasks.store') }}" method="post" class="space-y-6">
                @csrf
                <input type="text" name="title" placeholder="Task Title"
                    class="w-full px-6 py-4 border-2 border-blue-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-lg">
                <input type="text" name="description" placeholder="Task Description"
                    class="w-full px-6 py-4 border-2 border-blue-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none text-lg">
                <button type="submit"
                    class="w-full px-6 py-4 text-xl font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Add
                    Task</button>
            </form>
        </div>
    </div>
@endsection
