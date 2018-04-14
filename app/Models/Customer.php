<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'open_id','gender','nick_name','avatar_url','access_token'
    ];
}
