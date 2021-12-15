<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\EditGroupRequest;
use App\Models\Group;


class GroupController extends Controller
{
    public function create()
    {
        return view('admin.groups.create');
    }

    public function store(CreateGroupRequest $request)
    {
        Group::create($request->validated());

        return redirect()->route('home')->with('status', 'Group was successfully created.');
    }

    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    public function update(EditGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return redirect()->route('home')->with('status', 'Checklist group ' . $group->name . ' was successfully updated.');
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('home')->with('status', $group->name . ' was successfully deleted.');
    }
}
