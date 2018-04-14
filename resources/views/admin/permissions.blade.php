@extends('admin.admin')
@section('title','权限配置列表')
@section('dataType','generalComponents')
@section('content')
            @include('layouts.message')
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 权限列表
                    </div>

                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button type="button" onclick="window.open('{{ route('permission.create') }}','_self')" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
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
                                            <th class="table-check"><input type="checkbox" class="tpl-table-fz-check" onclick="swapCheck()"></th>
                                            <th class="table-id">ID</th>
                                            <th class="table-title">权限操作slug</th>
                                            <th class="table-type">权限名称</th>
                                            <th class="table-date am-hide-sm-only">修改日期</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if(count($permissions)>0)
                @foreach($permissions as $permission)
                                        <tr>
                                            <td><input type="checkbox"  name="ids[]" value="{{ $permission->id }}"></td>
                                            <td>{{ $permission->id }}</td>
                                            <td><a>{{ $permission->slug }}</a></td>
                                            <td class="am-hide-sm-only">{{ $permission->name }}</td>
                                            <td class="am-hide-sm-only">{{ $permission->created_at }}</td>
                                            <td>
                                               <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a class="am-btn am-btn-primary am-btn-xs" onclick="window.open('{{ route('permission.edit',$permission->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      <a class="am-btn am-btn-danger am-btn-xs" onclick="window.open('{{ route('permission.delete',['id'=>$permission->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                                            </td>
                                        </tr>
                @endforeach
                @endif
                                    </tbody>
                                </table>
                
                                <hr>

                            </form>
                        </div>
 <div class="am-cf">
            {{ $permissions->links() }}
            </div>
                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>

@endsection