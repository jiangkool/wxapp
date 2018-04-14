
@extends('layouts.admin')

@section('title','信息管理列表')

@section('content')
  <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">信息管理列表</strong> / <small>Articles</small></div>
      </div>

      <hr>
   @include('layouts.message')

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <button type="button" class="am-btn am-btn-success"  onclick="window.open('{{ route('article.create') }}','_self')"><span class="am-icon-plus"></span> 新增</button>
              <button type="button" class="am-btn am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          </div>
        </div>
        <form action="{{route('article.index')}}" method="get">
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-form-group">
            <select data-am-selected="{btnSize: 'sm'}" name="cat">
              <option value="">所有类别</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($_GET['cat']) && $_GET['cat']==$category->id) selected="selected" @endif>{{$category->category_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field" name="keywords" value="{{ isset($_GET['keywords']) && $_GET['keywords']? $_GET['keywords']:'' }}">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-success" type="submit">搜索</button>
          </span>
          </div>
        </div>
        </form>
      </div>

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">标题</th><th class="table-author am-hide-sm-only">所属分类</th><th class="table-title">缩略图</th><th class="table-title am-hide-sm-only">状态</th><th class="table-date am-hide-sm-only">更新时间</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @if(count($articles)>0)
                @foreach($articles as $article)
                <tr>
                <td><input type="checkbox" /></td>
                <td>{{ $article->id }}</td>
                <td><a href="{{ URL::route('article.edit',$article->id) }}" style="color: #545454;font-size: 14px">{{ msubstr($article->title,0,20) }}</a></td>
                <td class="am-hide-sm-only" style="color: #545454;font-size: 14px"><b>{{ $article->category->category_name }}</b></td>
                <td ><span class="am-badge am-radius">{{ $article->thumb!=''? '有':'无' }}</span></td>
                <td class="am-hide-sm-only" style="font-size: 14px"><span class="am-badge am-badge-success am-radius">{{ $article->status==1?'已审核':'待审核' }}</span> <span class="am-badge am-badge-warning am-radius">{{ $article->attr==1?'已推荐':'' }}</span> <span class="am-badge am-badge-danger am-radius">{{ $article->attr==2?'头条':'' }}</span></td>
                <td class="am-hide-sm-only">{{ $article->updated_at }}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a class="am-btn am-btn-primary am-btn-xs" onclick="window.open('{{ route('article.edit',$article->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      @if($article->status==1)
                      <a class="am-btn am-btn-warning am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('article.active',['id'=>$article->id,'active'=>0]) }} ','_self')"><span class="am-icon-copy"></span> 禁用</a>
                      @else
                      <a class="am-btn am-btn-success am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('article.active',['id'=>$article->id,'active'=>1]) }} ','_self')"><span class="am-icon-copy"></span> 审核</a>
                      @endif
                      <a class="am-btn am-btn-danger am-btn-xam-text-danger" onclick="window.open('{{ route('article.delete',['id'=>$article->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                </td>
                </tr>
                @endforeach
             @endif
              </tbody>
            </table>
            <div class="am-cf">
            {{ $articles->appends($_GET)->links() }}
          
            </div>
            <hr />
            <p>注：.....</p>
          </form>
        </div>

      </div>
    </div>
@endsection
