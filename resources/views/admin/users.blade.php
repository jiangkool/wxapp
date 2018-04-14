@extends('admin.admin')
@section('title','会员管理列表')
@section('dataType','generalComponents')
@section('content')
            @include('layouts.message')
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 会员列表
                    </div>

                </div>
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="am-u-sm-12 am-u-md-6">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button type="button" onclick="window.open('{{ route('users.create') }}','_self')" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
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
                                            <th class="table-title">用户名</th>
                                            <th class="table-title">Email</th>
                                            <th class="table-title am-hide-sm-only">状态</th>
                                            <th class="table-date am-hide-sm-only">更新时间</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if(count($users)>0)
                                         @foreach($users as $user)
                                         <tr><td><input type="checkbox"  name="ids[]"></td>
                <td>{{ $user->id }}</td>
                <td><a href="{{ URL::route('users.edit',$user->id) }}"><b>{{ $user->name }}</b></a></td>
                <td>{{ $user->email }}</td>
                <td class="am-hide-sm-only">{!! $user->active==1?'<span class="am-badge am-badge-success am-radius">已激活</span>':'<span class="am-badge am-badge-danger am-radius">已禁用</span>' !!}</td>
                <td class="am-hide-sm-only">{{ $user->created_at }}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a class="am-btn am-btn-primary am-btn-xs" onclick="window.open('{{ route('users.edit',$user->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      @if($user->active==-1)
                       <a class="am-btn am-btn-success am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('users.active',['id'=>$user->id,'active'=>1]) }} ','_self')"><span class="am-icon-check-circle"></span> 激活</a>
                      @else
                      <a class="am-btn am-btn-warning am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('users.active',['id'=>$user->id,'active'=>-1]) }} ','_self')"><span class="am-icon-times-circle"></span> 禁用</a>
                      @endif
                      <a class="am-btn am-btn-danger am-btn-xs am-hide-sm-only" onclick="window.open('{{ route('user.delete',['id'=>$user->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
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
            {{ $users->appends($_GET)->links() }}
            </div>
                    </div>
                </div>
                <div class="tpl-alert"></div>
            </div>

@endsection