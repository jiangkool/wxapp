<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
     protected $fillable = [
        'yminfo_id', 'server_id','local_path'
    ];
}
