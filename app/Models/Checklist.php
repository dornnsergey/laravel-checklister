<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_id',
        'user_id',
        'checklist_id',
        'last_user_action_at'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function isNew()
    {
        $ids = Checklist::where('user_id', auth()->user()->id)->pluck('checklist_id')->toArray();
        $value = ! in_array($this->id, $ids);

        $this->setAttribute('is_new', $value);
    }

    public function isUpdated()
    {
        $isNew = $this->is_new;
        $updated = $this->updated_at->greaterThan($this->lastUserActionAt());
        $value = !$isNew && $updated;

        $this->setAttribute('is_updated', $value);
    }

    public function lastUserActionAt()
    {
        return Checklist::where('user_id', auth()->user()->id)->where('checklist_id', $this->id)->value('last_user_action_at') ?? now()->subYears(10);
    }
}
