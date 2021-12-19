<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function isNew()
    {

        $value = $this->created_at->greaterThan($this->lastUserActionAt());

        return $this->setAttribute('is_new', $value);
    }

    public function isUpdated()
    {
        foreach ($this->checklists as $checklist) {
            $checklist->isNew();
            $checklist->isUpdated();

            $updated = false;
            if ($checklist->is_new || $checklist->is_updated) {
                $updated = true;
            }
        }

        $value = !$this->is_new && $updated;

        return $this->setAttribute('is_updated', $value);
    }

    public function lastUserActionAt()
    {
        return Checklist::where('group_id', $this->id)->where('user_id', auth()->user()->id)->max('last_user_action_at') ?? now()->subYears(10);
    }
}
