<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_id',
        'user_id',
        'checklist_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function isNew($lastUserActionAt)
    {
        $this->setAttribute('is_new', !$this->group->is_new && Carbon::create($this->created_at)->greaterThan($lastUserActionAt));
    }

    public function isUpdated($lastUserActionAt)
    {
        $this->setAttribute('is_updated', !$this->group->is_new && !$this->is_new && Carbon::create($this->updated_at)->greaterThan($lastUserActionAt));
    }
}
