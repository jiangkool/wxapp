<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
        $categories=Category::where('parent_id','=',0)->get();
        return view('admin.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Category::where('parent_id','=','0')->get();
        return view('admin.create_category',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request,[
                'parent_id'=>'required',
                'category_name'=>'required|max:30|unique:categories',
                'category_status'=>'required',
                'slug'=>'required'
            ]);
        if (Category::create(request(['parent_id','category_name','category_status','slug']))) {
           return redirect()->back()->with('message','新增分类成功！')->withInput();
        }else{
            return redirect()->back()->withErrors('新增分类失败！')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // dd($category);
        $parents=Category::where('parent_id','=','0')->get();
        $category=Category::find($id);

        return view('admin.category_edit',compact('parents','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get category eq
        $category=Category::find($id);

        if ($category->parent_id!=$request->parent_id) {
            $category->parent_id=$request->parent_id;
        }
         if ($category->category_name!=$request->category_name) {
            $category->category_name=$request->category_name;
        }
        if ($category->category_status!=$request->category_status) {
            $category->category_status=$request->category_status;
        }
        if ($category->slug!=$request->slug) {
            $category->slug=$request->slug;
        }

        if ($category->save()) {
            return redirect()->back()->with('message','分类已更新！');
        }else{
            return redirect()->back()->withErrors('分类更新失败！');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if (Category::where('parent_id','=',$id)->count()) {
            return redirect()->back()->withErrors('该栏目下含有子栏目，请先删除子栏目！');
        }else{

            Category::destroy($id);
            return redirect()->back()->with('message','删除成功！');
        }

    }
}
