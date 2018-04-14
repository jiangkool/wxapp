<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id','slug','category_name','category_status'
    ];

    public function article()
    {
    	return $this->hasMany(Article::class);
    }

    public static function get_position_links ($catid)
    {
    	$cate=self::findOrFail($catid);
    	$position['fcat']=[$cate->id,$cate->slug,$cate->category_name];

    	//暂时支持到2级栏目
    	if ($cate->parent_id!=0) {
    		$p_cate=self::findOrFail($cate->parent_id);
    		$position['pcat']=[$p_cate->id,$p_cate->slug,$p_cate->category_name];
    	}

    	return $position;
    }

    //根据catid获取栏目信息
    public static function getCategory($id)
    {
        $category=self::where('category_status',1)->where('id',$id)->get();

        return $category;
    }
}
