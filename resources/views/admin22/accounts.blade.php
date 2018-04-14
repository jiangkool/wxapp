@extends('layouts.admin')

@section('title','公众号管理列表')

@section('content')
  <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span class="am-icon-users"></span> 公众号管理列表</strong>  <small></small></div>
      </div>

      <hr>
   @include('layouts.message')

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-sm">
              <button type="button" class="am-btn am-btn-success am-round"  onclick="window.open('{{ route('account.create') }}','_self')"><span class="am-icon-plus"></span> 新增公众号</button>
            
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
                <th class="table-id">ID</th><th class="table-title">类型</th><th class="table-author">公众号名称</th><th class="table-title am-hide-sm-only">状态</th><th class="table-date am-hide-sm-only">添加时间</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @if(count($accounts)>0)
                @foreach($accounts as $account)
                <tr>
                <td>{{ $account->id }}</td>
                <td><a><b>{{ $account->account_type==1? '订阅号':'服务号' }}</b></a></td>
                <td>{{ $account->wechat_name }}</td>
                <td class="am-hide-sm-only">{!! $account->status==1?'<span class="am-badge am-badge-success am-radius">已激活</span>':'<span class="am-badge am-badge-danger am-radius">已禁用</span>' !!}</td>
                <td class="am-hide-sm-only">{{ $account->created_at }}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a class="am-btn am-btn-primary am-btn-xs" onclick="window.open('{{ route('account.edit',$account->id) }}','_self')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      @if($account->status==0)
                       <a class="am-btn am-btn-success am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('account.active',['id'=>$account->id,'active'=>1]) }} ','_self')"><span class="am-icon-check-circle"></span> 激活</a>
                      @else
                      <a class="am-btn am-btn-warning am-btn-xs am-hide-sm-only"  onclick="window.open('{{ route('account.active',['id'=>$account->id,'active'=>0]) }} ','_self')"><span class="am-icon-times-circle"></span> 禁用</a>
                      @endif
                      <a class="am-btn am-btn-danger am-btn-xs am-hide-sm-only" onclick="window.open('{{ route('account.delete',['id'=>$account->id]) }} ','_self')"><span class="am-icon-trash-o"></span> 删除</a>
                       <a class="am-btn am-btn-success am-btn-xs" data-am-modal="{target: '#modal-{!! $account->id !!}', closeViaDimmer: 0, width: 400, height: 225}"><span class="am-icon-cloud"></span> 接入</a>
                    </div>
                  </div>
                </td>
                </tr>
                <div class="am-modal am-modal-no-btn" tabindex="-1" id="modal-{!! $account->id !!}">
                  <div class="am-modal-dialog">
                    <div class="am-modal-hd"><b><span class="am-icon-weixin"> 微信公众号服务器配置</span></b>
                      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                    </div>
                    <div class="am-modal-bd">
                      <hr>
                      <blockquote style="text-align: left">
                      <span class="am-badge am-badge-success">URL:</span> <code style="font-weight: 700">{!!$app_url!!}/wechat/callback/{!! $account->id !!}</code>
                      <span class="am-badge am-badge-danger">Token :</span> <code style="font-weight: 700">{!! $account->wechat_token !!}</code>
                      </blockquote>
                    </div>
                  </div>
                </div>
                @endforeach
             @endif
              </tbody>
            </table>
            <div class="am-cf">
            {{ $accounts->appends($_GET)->links() }}
            </div>
            <hr />
            <p>注：.....</p>
          </form>
        </div>

      </div>
    </div>
@endsection