@extends('admin.admin')
@section('title','新增分类')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 新增分类
                    </div>
                </div>
<div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">


                        <div class="am-u-sm-12 am-u-md-9">
                            <form class="am-form am-form-horizontal" action="{{ route('category.store') }}" method="post">
                                {{csrf_field()}}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">父级栏目：</label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{btnSize: 'sm'}" name="parent_id">
                                          <option value="0">选择上级栏目</option>
                                          @if(count($parents)>0)
                                            @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->category_name }}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                    <small> (未选择默认顶级)</small>
                                    </div>
                                </div>

                                 <div class="am-form-group">
              <label for="category_name" class="am-u-sm-3 am-form-label">分类名称：</label>
              <div class="am-u-sm-9">
                <input type="text" name="category_name" id="category_name" placeholder="分类名称" value="{{ old('category_name') }}">
              </div>
            </div>
            <div class="am-form-group">
              <label for="slug" class="am-u-sm-3 am-form-label">路由名称slug：</label>
              <div class="am-u-sm-9">
                <input type="text" name="slug" id="slug" placeholder="路由名称" value="{{ old('slug') }}">
              </div>
            </div>
            <div class="am-form-group">
              <label for="category_status" class="am-u-sm-3 am-form-label">是否激活：</label>
              <div class="am-u-sm-9">
              <label>
                <input type="radio" name="category_status"  value="1" checked> <small>启用</small>
                </label>
                <label>
                <input type="radio" name="category_status"  value="0"> <small>禁用</small>
                </label>
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