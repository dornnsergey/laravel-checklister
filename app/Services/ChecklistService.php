<?php


namespace App\Services;

use App\Models\Checklist;


class ChecklistService
{
    public function syncChecklist(Checklist $checklist, $user_id): Checklist
    {
        return Checklist::firstOrCreate(
            [
                'user_id' => $user_id,
                'checklist_id' => $checklist->id
            ],
            [
                'group_id' => $checklist->group_id,
                'name' => $checklist->name,
            ]);
    }
}
