<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'account_type','wechat_name','app_id','app_secret','wechat_token','encoding_aes_key','url_type','status'
    ];
}
