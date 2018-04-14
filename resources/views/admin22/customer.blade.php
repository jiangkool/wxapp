@extends('layouts.admin')

@section('title','访客列表')

@section('content')
  <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span class="am-icon-calendar"></span> 访客列表</strong> </div>
      </div>
      <hr>
     @include('layouts.message')

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-id">ID</th><th class="table-title">昵称</th><th class="table-title">性别</th><th class="table-title">头像</th><th class="table-title am-hide-sm-only">最后访问</th>
              </tr>
              </thead>
              <tbody>
              @if(count($customers)>0)
                @foreach($customers as $customer)
                <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->nick_name?:'匿名' }}</td>
                <td>{{ $customer->gender==0? '男':'女' }}</td>
                <td>@if(isset($customer->avatar_url))<img src="{{ $customer->avatar_url }}" width="60" height="60">@else 暂无 @endif</td>
                <td class="am-hide-sm-only">{{ $customer->updated_at }}</td>
                </tr>
                @endforeach
             @endif
              </tbody>
            </table>
            <div class="am-cf">
            {{ $customers->links() }}
            </div>
            <hr />
            <p>注：.....</p>
          </form>
        </div>

      </div>
    </div>
@endsection