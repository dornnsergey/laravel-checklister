<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChecklistRequest;
use App\Http\Requests\EditChecklistRequest;
use App\Models\Checklist;
use App\Models\Group;

class ChecklistController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Group $group)
    {
        return view('admin.checklists.create', compact('group'));
    }

    public function store(CreateChecklistRequest $request, Group $group)
    {
        $group->checklists()->create($request->validated());

        return redirect()->route('welcome')->with('status', 'Checklist was successfully created in ' . $group->name . '.');
    }

    public function show(Group $group, Checklist $checklist)
    {
        $tasks = $checklist->load('tasks')->tasks()->get();

        return view('admin.checklists.show', compact('group', 'checklist', 'tasks'));
    }

    public function edit(Group $group, Checklist $checklist)
    {
        return view('admin.checklists.edit', compact('group', 'checklist'));
    }

    public function update(EditChecklistRequest $request, Group $group, Checklist $checklist)
    {
        $checklist->update($request->validated());

        return redirect()->route('welcome')->with('status', 'Checklist ' . $checklist->name . ' was successfully updated.');
    }

    public function destroy(Group $group, Checklist $checklist)
    {
        $checklist->delete();

        return redirect()->route('welcome')->with('status', 'Checklist was successfully deleted.');
    }
}
