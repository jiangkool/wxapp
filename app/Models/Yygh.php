<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yygh extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'open_id', 'name', 'phone','xmid','keshi','yytime','bark','status'
    ];

    public function article()
    {
    	return $this->hasOne(Article::class,'id','xmid');
    }

}
