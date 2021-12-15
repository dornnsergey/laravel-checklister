<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChecklistRequest;
use App\Http\Requests\EditChecklistRequest;
use App\Models\Checklist;
use App\Models\Group;
use Illuminate\Http\Request;

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

        return redirect()->route('home')->with('status', 'Checklist was successfully created in ' . $group->name . '.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Group $group, Checklist $checklist)
    {
        return view('admin.checklists.edit', compact('group', 'checklist'));
    }

    public function update(EditChecklistRequest $request, Group $group, Checklist $checklist)
    {
        $checklist->update($request->validated());

        return redirect()->route('home')->with('status', 'Checklist ' . $checklist->name . ' was successfully updated.');
    }

    public function destroy(Group $group, Checklist $checklist)
    {
        $checklist->delete();

        return redirect()->route('home')->with('status', 'Checklist was successfully deleted.');
    }
}
