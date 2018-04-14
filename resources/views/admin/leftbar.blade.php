@if((Auth::check()&& Session::has('admin_permissions'))||Auth::user()->id==1)
<div class="tpl-left-nav tpl-left-nav-hover">
<div class="tpl-left-nav-title">
菜单分类
</div>
<div class="tpl-left-nav-list">
<ul class="tpl-left-nav-menu">
<li class="tpl-left-nav-item">
<a href="{{ route('login')}}" class="nav-link  @if(request()->is('admin/login')) active @endif">
<i class="am-icon-home"></i>
<span>首页</span>
</a>
</li>
@if(array_key_exists('category.index',Session::get('admin_permissions')))
<li class="tpl-left-nav-item">
<a href="{{ route('category.index') }}" class="nav-link tpl-left-nav-link-list @if(request()->is('admin/category')) active @endif" >
<i class="am-icon-bar-chart"></i>
<span>分类管理</span>
<i class="am-icon-angle-right tpl-left-nav-content-ico am-fr am-margin-right"></i>
</a>
</li>
@endif
 @if(array_key_exists('account.index',Session::get('admin_permissions')))
        <li class="tpl-left-nav-item">
        <a href="javascript:;" class="nav-link tpl-left-nav-link-list  @if(request()->is('admin/article')) active @endif">
<i class="am-icon-table"></i>
<span>公众号管理</span>
<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
</a>
<ul class="tpl-left-nav-sub-menu"  @if(request()->is('admin/account')) style="display:block" @endif>
            <li>
                <a href="{{route('account.index')}}">
                <i class="am-icon-angle-right"></i>
                <span>公众号列表</span>
                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                </a>
                 <a href="{{route('account.create')}}">
                <i class="am-icon-angle-right"></i>
                <span>添加公众号</span>
                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                </a>
            </li>
        </ul>
        </li>
        @endif
 @if(array_key_exists('customer.index',Session::get('admin_permissions')))
<li class="tpl-left-nav-item">
        <a href="javascript:;" class="nav-link tpl-left-nav-link-list  @if(request()->is('admin/article')) active @endif">
<i class="am-icon-table"></i>
<span>访客管理</span>
<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
</a>
<ul class="tpl-left-nav-sub-menu"  @if(request()->is('admin/customer')) style="display:block" @endif>
            <li>
                <a href="{{route('customer.index')}}">
                <i class="am-icon-angle-right"></i>
                <span>访客列表</span>
                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                </a>
            </li>
        </ul>
        </li>

 @endif
 @if(array_key_exists('yygh.index',Session::get('admin_permissions')))
<li class="tpl-left-nav-item">
<a href="{{ route('yygh.index') }}" class="nav-link tpl-left-nav-link-list @if(request()->is('admin/yygh')) active @endif" >
<i class="am-icon-bar-chart"></i>
<span>预约管理</span>
<i class="am-icon-angle-right tpl-left-nav-content-ico am-fr am-margin-right"></i>
</a>
</li>
@endif
@if(array_key_exists('article.index',Session::get('admin_permissions')))
<li class="tpl-left-nav-item">
<a href="javascript:;" class="nav-link tpl-left-nav-link-list  @if(request()->is('admin/article')) active @endif">
<i class="am-icon-table"></i>
<span>文档管理</span>
<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
</a>
    <ul class="tpl-left-nav-sub-menu"  @if(request()->is('admin/article')) style="display:block" @endif>
        <li>
        <a href="{{route('article.index')}}">
        <i class="am-icon-angle-right"></i>
        <span>文档管理</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>

        <a href="table-images-list.html">
        <i class="am-icon-angle-right"></i>
        <span>图片文档</span>
        <i class="tpl-left-nav-content tpl-badge-success">
        18
        </i>

        <a href="form-news.html">
        <i class="am-icon-angle-right"></i>
        <span>消息列表</span>
        <i class="tpl-left-nav-content tpl-badge-primary">
        5
        </i>
        <a href="form-news-list.html">
        <i class="am-icon-angle-right"></i>
        <span>文字列表</span>

        </a>
        </li>
    </ul>
</li>
@endif

@if(array_key_exists('users.index',Session::get('admin_permissions')) || array_key_exists('roles.index',Session::get('admin_permissions')) || array_key_exists('permission.index',Session::get('admin_permissions')) || Auth::user()->id==1)
<li class="tpl-left-nav-item">
<a href="javascript:;" class="nav-link tpl-left-nav-link-list  @if(request()->is('admin/users')||request()->is('admin/roles')||request()->is('admin/permission')) active @endif">
<i class="am-icon-users"></i>
<span>权限管理</span>
<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
</a>
    <ul class="tpl-left-nav-sub-menu"  @if(request()->is('admin/users')||request()->is('admin/roles')||request()->is('admin/permission')) style="display:block" @endif>
        <li>
         @if(array_key_exists('users.index',Session::get('admin_permissions'))|| Auth::user()->id==1)
        <a href="{{ route('users.index',['is_admin'=>0]) }}">
        <i class="am-icon-angle-right"></i>
        <span>前台会员管理</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
        @endif
       @if(array_key_exists('users.index',Session::get('admin_permissions'))|| Auth::user()->id==1)
        <a href="{{ route('users.index',['is_admin'=>1]) }}">
        <i class="am-icon-angle-right"></i>
        <span>管理员管理</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
        @endif
        @if(array_key_exists('roles.index',Session::get('admin_permissions'))|| Auth::user()->id==1)
        <a href="{{ route('roles.index') }}">
        <i class="am-icon-angle-right"></i>
        <span>角色管理</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
         @endif
         @if(array_key_exists('permission.index',Session::get('admin_permissions'))|| Auth::user()->id==1)
         <a href="{{ route('permission.index') }}">
        <i class="am-icon-angle-right"></i>
        <span>权限配置</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
         @endif
        </li>
    </ul>
</li>
@endif
@if(array_key_exists('system',Session::get('admin_permissions'))|| Auth::user()->id==1)
<li class="tpl-left-nav-item">
<a href="javascript:;" class="nav-link tpl-left-nav-link-list">
<i class="am-icon-cog"></i>
<span>系统信息</span>
<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
</a>
    <ul class="tpl-left-nav-sub-menu">
        <li>
        <a href="{{route('system')}}">
        <i class="am-icon-angle-right"></i>
        <span>系统配置</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
         <a href="{{route('user.log')}}">
        <i class="am-icon-angle-right"></i>
        <span>系统日志</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
        <a href="{{route('system.clear-cache')}}">
        <i class="am-icon-angle-right"></i>
        <span>清除缓存</span>
        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
        </a>
        </li>
    </ul>
</li>
 @endif
<li class="tpl-left-nav-item">
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link tpl-left-nav-link-list">
<i class="am-icon-key"></i>
<span>注销</span>
</a>
</li>
</ul>
</div>
</div>
  @endif