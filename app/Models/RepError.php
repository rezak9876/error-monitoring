<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepError extends Model
{
    use HasFactory;

    protected $table = 'errors';
    protected $fillable = [
        'Language',
        'Message',
        'Code',
        'File',
        'Line',
        'Trace'
    ];

    public function systems()
    {
        return $this->belongsToMany(System::class, 'error_system',  'error_id', 'system_id');
    }
}
