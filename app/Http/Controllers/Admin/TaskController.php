<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Checklist;
use App\Models\Task;


class TaskController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Checklist $checklist)
    {
        return view('admin.tasks.create', compact('checklist'));
    }

    public function store(CreateTaskRequest $request, Checklist $checklist)
    {
        $checklist->tasks()->create($request->validated());

        return redirect()->route('admin.groups.checklists.show', [$checklist->group_id, $checklist->id]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Checklist $checklist, Task $task)
    {
        return view('admin.tasks.edit', compact('checklist', 'task'));
    }

    public function update(EditTaskRequest $request, Checklist $checklist, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('admin.groups.checklists.show', [$checklist->group_id, $checklist]);
    }

    public function destroy(Checklist $checklist, Task $task)
    {
        $task->delete();

        return redirect()->route('admin.groups.checklists.show', [$checklist->group_id, $checklist]);
    }
}
