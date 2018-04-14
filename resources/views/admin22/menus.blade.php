@extends('layouts.admin')

@section('title','自定义菜单')

@section('content')
  <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><span class="am-icon-calendar"></span> 自定义菜单</strong> </div>
      </div>
      <hr>
     @include('layouts.message')

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-id">ID</th><th class="table-title">用户名</th><th class="table-author">操作记录</th><th class="table-title am-hide-sm-only">记录时间</th>
              </tr>
              </thead>
              <tbody>
              @if(count($menus)>0)
                @foreach($menus as $menu)
                <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->type }}</td>
                <td>{{ $menu->name }}</td>
                <td class="am-hide-sm-only">{{ $menu->created_at }}</td>
                </tr>
                @if(isset($menu[sub_button]))
                  @foreach($sub_button as $sub_button_item)
                    <tr>
                    <td>{{ $sub_button_item->id }}</td>
                    <td>{{ $sub_button_item->username }}</td>
                    <td>{{ $sub_button_item->action }}</td>
                    <td class="am-hide-sm-only">{{ $sub_button_item->created_at }}</td>
                   </tr>
                   @endforeach
                @endif
                @endforeach
             @endif
              </tbody>
            </table>
            <hr />
            <p>注：.....</p>
          </form>
        </div>

      </div>
    </div>
@endsection