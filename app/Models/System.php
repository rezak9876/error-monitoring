<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class System extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'domain', 'app_name'
    ];

    public function errors()
    {
        return $this->belongsToMany(RepError::class, 'error_system', 'system_id', 'error_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function user()
    {
        return $this->project->user();
    }

    public function errorsCount()
    {
        return RepError::whereHas('systems', function (Builder $query) {
            $query->where('systems.id', $this->id);
        })->get()->count();
    }

    public function getTitleShow()
    {
        $domain = $this->domain;
        if ($this->title)
            return $this->title;
        if ($this->app_name)
            return $this->app_name;
        return substr($domain, strpos($domain, '//') + 2);
    }
}
