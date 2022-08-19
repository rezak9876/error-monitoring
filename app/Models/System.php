<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class System extends Model
{
    use HasFactory;


    protected $fillable = [
        'domain', 'dbName'
    ];

    public function errors()
    {
        return $this->belongsToMany(RepError::class, 'error_system', 'system_id', 'error_id');
    }

    public function errorsCount()
    {
        return RepError::whereHas('systems', function (Builder $query) {
            $query->where('systems.id', $this->id);
        })->get()->count();
    }
}
