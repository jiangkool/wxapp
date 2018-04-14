<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
// use Actuallymab\LaravelComment\Commentable;

class Article extends Model
{
    // use Commentable;

    // protected $mustBeApproved = true;

    protected $fillable = [
        'title','category_id','thumb','new_price','zj_zc','cz_time','zj_sc','user_id','old_price','body','file_path','file_name','file_size','status','attr','click'
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public static function getCategoryNameByAid($id)
    {
    	if($artModel=Article::find($id)){
    		return $artModel->category->category_name;
    	}else{
    		return ;
    	}
    }

    public static function getHotArticles($catid='')
    {
        if (!empty($catid)) {
            $data=self::where('category_id',$catid)->where('status',1)->orderBy('click','desc')->get();
            return $data->take(5)->all();
        }else{
            $data=self::where('status',1)->orderBy('click','desc')->get();
            return $data->take(5)->all();
        }
    }

    /*
    * $catid 栏目id 可为空
    * $attr 文档属性 0默认 1推荐 2头条
    * $num 文档条数 默认0
    * @return collection 
    */
    public static function getArticlesByAttr($catid='',$attr=0,$num=0)
    {
        if (!empty($catid)) {
            $data= self::where('category_id',$catid)->where('status',1)->where('attr',$attr)->get();
            return $data->take($num)->all();
        }else{
            $data= self::where('status',1)->where('attr',$attr)->get();
             return $data->take($num)->all();
        }
    }

    //获取最新文档 数目 $num
    public static function getLatestArts($num=2)
    {
        $arts=self::where('status',1)->orderBy('id','desc')->get()->take($num);

        return $arts->all();
    }


    //获取关联发布作者

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }


}
