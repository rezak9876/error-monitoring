<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepError extends Model
{
    use HasFactory;

    protected $table = 'errors';
    protected $fillable = [
        'Message',
        'Code',
        'File',
        'Line',
        'Trace'
    ];
}
