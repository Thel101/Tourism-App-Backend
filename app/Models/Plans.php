<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $casts=[
        'interests' => 'json',
        'special_requests'=> 'json',
        'expenses'=> 'json',
    ];
}
