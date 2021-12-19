<?php

namespace App\Http\View\Composers;


use Carbon\Carbon;
use Illuminate\View\View;

class GroupsComposer
{
    public function compose(View $view)
    {
        $groups = \App\Models\Group::with(['checklists' => function ($query) {
            $query->whereNull('user_id');
        }])
            ->when(!auth()->user()->is_admin, fn($query) => $query->has('checklists'))
            ->get();

        if (!auth()->user()->is_admin) {
            $groups->map(function ($group) {
                $group->isNew();
                $group->isUpdated();
            })->all();
        }

        $view->with('groups', $groups);
    }
}
