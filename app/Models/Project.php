<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'language', 'token'
    ];

    // public function errors()
    // {
    //     return $this->belongsToMany(RepError::class, 'error_project', 'project_id', 'error_id')->withPivot('count');
    // }

    public function systems()
    {
        return $this->hasMany(System::class);
    }

    public function errors()
    {
        return RepError::whereHas('systems', function (Builder $query) {
            $query->where('project_id',$this->id);
        })->get();
    }
    
    public function errorsCount()
    {
        return $this->errors()->count();
    }
}
