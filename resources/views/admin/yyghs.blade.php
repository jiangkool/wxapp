@extends('admin.admin')
@section('title','预约信息管理列表')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 预约信息管理列表
                    </div>
                </div>
                 <div class="am-g">
        <div class="am-u-sm-12" style="padding-bottom: 15px">
        <form action="{{route('yygh.index')}}" method="get">
        <div class="am-u-sm-12 am-u-lg-3 am-u-lg-offset-9">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field" name="keywords" value="{{ isset($_GET['keywords']) && $_GET['keywords']? $_GET['keywords']:'' }}">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-success" type="submit">搜索</button>
          </span>
          </div>
        </div>
        </form>
        </div>
      </div>
      <div class="tpl-block ">
            <div class="am-g tpl-amazeui-form">
           <div class="am-u-sm-12">
           <form class="am-form">
            <table class="am-table  am-table-radius am-table-bordered am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">姓名</th><th class="table-author am-hide-sm-only">电话</th><th class="table-title">活动|项目</th><th class="table-title am-hide-sm-only">状态</th><th class="table-date am-hide-sm-only">留言时间</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @if(count($yyghs)>0)
                @foreach($yyghs as $yygh)
                <tr>
                <td><input type="checkbox" /></td>
                <td>{{ $yygh->id }}</td>
                <td><a  style="color: #545454;font-size: 14px">{{ $yygh->name }}</a></td>
                <td class="am-hide-sm-only" style="color: #545454;font-size: 14px"><b>{{ $yygh->phone }}</b></td>
                <td ><span class="am-badge am-radius am-badge-success">{{ $yygh->keshi?:$yygh->article->title }}</span></td>
                <td ><span class="am-badge am-radius">{{ $yygh->status==0 ? '未回访':'已回访' }}</span></td>
                <td class="am-hide-sm-only">{{ $yygh->created_at }}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      @if($yygh->status==0)
                      <a class="am-btn am-btn-success am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('yygh.active',['id'=>$yygh->id,'active'=>1]) }} ','_self')"><span class="am-icon-copy"></span> 回访</a>
                      @endif
                      <a class="am-btn am-btn-danger am-btn-xam-text-danger" onclick="window.open('{{ route('yygh.delete',['id'=>$yygh->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                </td>
                </tr>
                @endforeach
             @endif
              </tbody>
            </table>
            <div class="am-cf">
            {{ $yyghs->appends($_GET)->links() }}
          
            </div>
            <hr />
            <p>注：.....</p>
          </form>
                        </div>
                    </div>
                </div>
</div>
@endsection