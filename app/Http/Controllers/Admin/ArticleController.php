<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Flash;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_model=Article::query();

        if ($cat=request('cat')) {
            $article_model->where('category_id',$cat);
        }
        if ($keywords=request('keywords')) {
            $article_model->where('title','like','%'.$keywords.'%');
        }
        //get all articles
        $articles=$article_model->orderBy('id','desc')->paginate(15);

        //get all categories
        $categories=Category::all();
       
        return view('admin.articles',compact(['articles','categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys=Category::all();
        return view('admin.create_article',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input
        $this->validate($request,[
                'category_id'=>'required|integer',
                'title'      =>'required|unique:articles',
                'body'       =>'required'
            ]);
        
        $attr=empty($request->attr)?0:$request->attr;

        //create data
        if (Article::create(['category_id'=>$request->category_id,'title'=>$request->title,'thumb'=>\Config::get('app.url', '').$request->thumb,'new_price'=>$request->new_price,'old_price'=>$request->old_price,'zj_zc'=>$request->zj_zc,'cz_time'=>$request->cz_time,'zj_sc'=>$request->zj_sc,'body'=>$request->body,'attr'=>$attr,'user_id'=>Auth::user()->id])) {

            //$user=User::find(1);
            //$arts=Article::where('title',$request->title)->first();
            //$user->notify(new ReportAdd($arts));


           return redirect()->back()->with('message','信息发布成功！')->withInput();
        }else{
            return redirect()->back()->withError('信息发布失败！')->withInput();
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get model 
        $article=Article::findOrFail($id);
        $categorys=Category::all();
        return view('admin.article_edit',compact('article','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get model
        $article=Article::findOrFail($id);

        $article->category_id!=$request->category_id && $article->category_id=$request->category_id;
        isset($request->title) && $article->title!=$request->title && $article->title=$request->title;
        $article->new_price!=$request->new_price && $article->new_price=$request->new_price;
        $article->old_price!=$request->old_price && $article->old_price=$request->old_price;
        $article->zj_zc!=$request->zj_zc && $article->zj_zc=$request->zj_zc;
        $article->zj_sc!=$request->zj_sc && $article->zj_sc=$request->zj_sc;
        $article->cz_time!=$request->cz_time && $article->cz_time=$request->cz_time;
        $article->thumb!=$request->thumb && $article->thumb=\Config::get('app.url').$request->thumb;
        $article->attr!=$request->attr && $article->attr=$request->attr;
        isset($request->body) && $article->body!=$request->body && $article->body=$request->body;

        if ($article->save()) {
            return redirect()->back()->with('message','更新成功！');
        }else{
            return reqirect()->back()->withError('更新失败！');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=Article::findOrFail($id);
        if (Article::destroy($id)) {
            return redirect()->back()->with('message','删除成功！');
        }else{
            return redirect()->back()->withError('删除失败！');
        }

    }

    /**
     * Update article status.
     * 
     * @param  Request $request 
     * @param  int  $id    
     * @return redirect()           
     */
    public function active(Request $request,$id)
    {
        $article=Article::findOrFail($id);
        if ($article->status!=$request->active) {

            if (in_array($request->active,[0,1])) {

                $article->status=$request->active;
                $article->save();
                return redirect()->back()->with('message','更新成功！');
            }else{
                return redirect()->back()->withError('更新失败！');
            }
            
        }else{
            return redirect()->back()->with('message','更新成功！');
        }

    }
}
