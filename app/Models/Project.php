<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
