@extends('layouts.admin')

@section('title','增加分类')

@section('content')
<div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">增加分类</strong> / Create Category<small></small></div>
      </div>

      <hr/>

      <div class="am-g">
         @include('layouts.message')
        <div class="am-u-sm-12 am-u-md-8">
          <form class="am-form am-form-horizontal" action="{{ route('category.store') }}" method="post">
          {{csrf_field()}}
          <div class="am-form-group">
           <label for="parent_id" class="am-u-sm-3 am-form-label">上级栏目：</label>
              <div class="am-u-sm-9">
            <select data-am-selected="{btnSize: 'sm'}" name="parent_id">
              <option value="0">选择上级栏目(默认顶级)</option>
              @if(count($parents)>0)
                @foreach($parents as $parent)
                <option value="{{ $parent->id }}">{{ $parent->category_name }}</option>
                @endforeach
              @endif
            </select>
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
                <input type="radio" name="category_status"  value="1" checked> 启用
                </label>
                <label>
                <input type="radio" name="category_status"  value="0"> 禁用
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
@endsection