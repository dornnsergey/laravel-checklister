<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function isNew($lastUserActionAt)
    {
        return $this->setAttribute('is_new', Carbon::create($this->created_at)->greaterThan($lastUserActionAt));
    }

    public function isUpdated($lastUserActionAt)
    {
        return $this->setAttribute('is_updated', !($this->is_new) && Carbon::create($this->updated_at)->greaterThan($lastUserActionAt));
    }
}
