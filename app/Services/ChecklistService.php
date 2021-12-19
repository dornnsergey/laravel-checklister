<?php


namespace App\Services;

use App\Models\Checklist;


class ChecklistService
{
    public function syncChecklist(Checklist $checklist, $user_id): Checklist
    {
        $checklist = Checklist::firstOrCreate(
            [
                'user_id' => $user_id,
                'checklist_id' => $checklist->id
            ],
            [
                'group_id' => $checklist->group_id,
                'name' => $checklist->name,
            ]);

        $checklist->last_user_action_at = now();
        $checklist->timestamps = false;
        $checklist->save();

        return $checklist;
    }
}
