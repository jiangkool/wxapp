<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Yygh;
use App\Http\Controllers\Controller;

class YyghController extends Controller
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
        $article_model=Yygh::query();

        if ($keywords=request('keywords')) {
            $article_model->where('name','like','%'.$keywords.'%')->orWhere('phone','like','%'.$keywords.'%');
        }
        //get all yyghs
        $yyghs=$article_model->paginate(15);
       
        return view('admin.yyghs',compact('yyghs'));
    }

    //文档审核状态
    public function active(Request $request,$id)
    {
        $article=Yygh::findOrFail($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Yygh  $Yygh
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=Yygh::findOrFail($id);
        if (Yygh::destroy($id)) {
            return redirect()->back()->with('message','删除成功！');
        }else{
            return redirect()->back()->withError('删除失败！');
        }

    }



}
