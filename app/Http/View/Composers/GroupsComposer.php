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


        $lastUserActionAt = auth()->user()->last_action_at;
        if (is_null($lastUserActionAt)) {
            $lastUserActionAt = now()->subYears(10);
        }

        $groups->map(function ($group) use ($lastUserActionAt) {
            $group->isNew($lastUserActionAt);
            $group->isUpdated($lastUserActionAt);
            $group->checklists->map(function ($checklist) use ($lastUserActionAt) {
                $checklist->isNew($lastUserActionAt);
                $checklist->isUpdated($lastUserActionAt);
            });
            })
            ->all();
        // dd($userGroups);


        $view->with('groups', $groups);
    }
}
