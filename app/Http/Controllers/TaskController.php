<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return $this->successResponse(Task::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->successResponse(Task::findOrFail($id));
    }

    /**
     * Reorder the specified resource in storage.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'taskIds' => 'required|array',
            'taskIds.*' => 'integer'
        ]);

        $taskIds = $request->input('taskIds');

        foreach ($taskIds as $index => $id) {
            $task = Task::findOrFail($id);
            $task->priority = $index + 1;
            $task->save();
        }

        return $this->successResponse(['message' => 'Tasks reordered successfully.'],200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->successResponse(Task::findOrFail($id)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->successResponse(Task::findOrFail($id)->delete());
    }
}
