<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreate as TaskCreateRequest;
use App\Http\Requests\TaskList as TaskListRequest;
use App\Http\Requests\TaskUpdate as TaskUpdateRequest;
use App\Task;

class TaskController extends Controller
{
    public function index(TaskListRequest $request)
    {
        $tasks = Task::getList($request);

        return response()->json($tasks);
    }

    public function store(TaskCreateRequest $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::where('id', $id)->first();
        if (!$task) {
            return response(null, 404);
        }
        return response()->json($task);
    }

    public function update(TaskUpdateRequest $request, $id)
    {
        $task = Task::where('id', $id)->first();

        if (!$task) {
            return response(null, 404);
        }

        $task->update($request->all());

        return response()->json($task, 202);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        if (!$task) {
            return response(null, 404);
        }
        $task->delete();
        return response(null,204);
    }
}
