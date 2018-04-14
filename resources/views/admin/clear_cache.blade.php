@extends('admin.admin')
@section('title','清除缓存！')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 清除缓存！
                    </div>
                </div>

      <div class="tpl-block ">
             <div class="am-alert am-alert-success" data-am-alert>
          <button type="button" class="am-close">&times;</button>
           <p><span class="am-icon-check-circle"></span> <b>缓存已更新！</b></p>
          </div>
                </div>
</div>
@endsection