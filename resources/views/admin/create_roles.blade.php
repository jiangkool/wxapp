@extends('admin.admin')
@section('title','增加角色')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 增加角色
                    </div>
                </div>
<div class="tpl-block ">
            <div class="am-g tpl-amazeui-form">
           <div class="am-u-sm-12 am-u-md-9">
           <form class="am-form am-form-horizontal" action="{{ route('roles.store') }}" method="post">
          {{csrf_field()}}
            <div class="am-form-group">
              <label for="name" class="am-u-sm-3 am-form-label">角色名称：</label>
              <div class="am-u-sm-9">
                <input type="text" name="name" id="name" placeholder="角色名称" value="{{ old('name') }}">
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