@extends('admin.admin')
@section('title','分类列表管理')
@section('dataType','generalComponents')
@section('content')
            @include('layouts.message')
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 分类列表
                    </div>

                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button type="button" onclick="window.open('{{ route('category.create') }}','_self')" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                    <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="am-g">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                            <th class="table-id">ID</th>
                                            <th class="table-title">栏目名称</th>
                                            <th class="table-type">slug</th>
                                            <th class="table-author am-hide-sm-only">状态</th>
                                            <th class="table-date am-hide-sm-only">发布日期</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if(count($categories)>0)
                @foreach($categories as $category)
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>{{ $category->id }}</td>
                                            <td><a href="{{ route('category.edit',$category->id) }}">{{ $category->category_name }}</a></td>
                                            <td>{{ $category->slug }}</td>
                                            <td class="am-hide-sm-only">{{ $category->category_status==1?'已激活':'已禁用' }}</td>
                                            <td class="am-hide-sm-only">{{ $category->created_at }}</td>
                                            <td>
                                               <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a class="am-btn am-btn-primary am-btn-xs" onclick="window.open('{{ route('category.edit',$category->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      <a class="am-btn am-btn-danger am-btn-xs am-hide-sm-only" onclick="window.open('{{ route('category.delete',['id'=>$category->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                                            </td>
                                        </tr>
                @if($sonCates=App\Models\Category::where('parent_id','=',$category->id)->get())
                  @foreach($sonCates as $sonCate)
                    <tr>
                    <td><input type="checkbox"></td>
                    <td>{{ $sonCate->id }}</td>
                    <td><a href="{{ route('category.edit',$sonCate->id) }}">{{ $sonCate->category_name }}</a></td>
                    <td>{{ $sonCate->slug }}</td>
                    <td class="am-hide-sm-only">{{ $sonCate->category_status==1?'已激活':'已禁用' }}</td>
                    <td class="am-hide-sm-only">{{ $sonCate->created_at }}</td>
                    <td>
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                              <a class="am-btn am-btn-default am-btn-xs " onclick="window.open('{{ route('category.edit',$sonCate->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                              <a class="am-btn am-btn-default am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('category.update',['id'=>$sonCate->id,'active'=>-1]) }} ','_self')"><span class="am-icon-copy"></span> 禁用</a>
                              <a class="am-btn am-btn-default am-btn-xs am-hide-sm-only" onclick="window.open('{{ route('category.delete',['id'=>$sonCate->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                            </div>
                          </div>
                    </td>
                </tr>
                @endforeach
                @endif
                @endforeach
                @endif
                                    </tbody>
                                </table>
                
                                <hr>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>

@endsection