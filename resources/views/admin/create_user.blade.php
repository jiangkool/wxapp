@extends('admin.admin')
@section('title','增加管理员')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 增加管理员
                    </div>
                </div>
<div class="tpl-block ">
            <div class="am-g tpl-amazeui-form">
           <div class="am-u-sm-12 am-u-md-9">
            <form class="am-form am-form-horizontal" action="{{ route('users.store') }}" method="post">
          {{csrf_field()}}
            <div class="am-form-group">
              <label for="name" class="am-u-sm-3 am-form-label">用户名：</label>
              <div class="am-u-sm-9">
                <input type="text" name="name" id="name" placeholder="用户名" value="{{ old('name') }}">
              </div>
            </div>

            <div class="am-form-group">
              <label for="password" class="am-u-sm-3 am-form-label">密码：</label>
              <div class="am-u-sm-9">
                <input type="password" name="password" id="password" placeholder="密码" >
              </div>
            </div>

            <div class="am-form-group">
              <label for="password_confirmation" class="am-u-sm-3 am-form-label">确认密码：</label>
              <div class="am-u-sm-9">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="确认密码" >
              </div>
            </div>

            <div class="am-form-group">
              <label for="email" class="am-u-sm-3 am-form-label">Email：</label>
              <div class="am-u-sm-9">
                <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
              </div>
            </div>

            <div class="am-form-group">
              <label for="roles[]" class="am-u-sm-3 am-form-label">角色：</label>
              <div class="am-u-sm-9">
                 @foreach($perms as $perm)
                 <div class="am-checkbox">
                  <label>
                    <input type="checkbox" value="{{ $perm->id }}" name="roles[]" >{{ $perm->name }}
                  </label>
                </div>
                 @endforeach
              </div>
            </div>


            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="submit" class="am-btn am-btn-primary">保存提交</button>
              </div>
            </div>
          </form>
                        </div>
                    </div>
                </div>
</div>
@endsection