@extends('layouts.admin')

@section('title','增加管理员')

@section('content')
<div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加公众号</strong>  <small></small></div>
      </div>

      <hr/>

      <div class="am-g">
       @include('layouts.message')
        <div class="am-u-sm-12 am-u-md-8">
          <form class="am-form am-form-horizontal" action="{{ route('account.store') }}" method="post">
          {{csrf_field()}}
            <div class="am-form-group">
              <label for="account_type" class="am-u-sm-3 am-form-label">帐号类型：</label>
              <div class="am-u-sm-9">
                <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="1" name="account_type" @if(old('account_type')==1) checked="checked" @endif >订阅号
                  </label>
                </div>
                 <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="2" name="account_type" @if(old('account_type')==2) checked="checked" @endif>服务号
                  </label>
                </div>
              </div>
            </div>

            <div class="am-form-group">
              <label for="wechat_name" class="am-u-sm-3 am-form-label">公众号名称:</label>
              <div class="am-u-sm-9">
                <input type="text" name="wechat_name" value="{{ old('wechat_name') }}" />
              </div>
            </div>

            <div class="am-form-group">
              <label for="app_id" class="am-u-sm-3 am-form-label">APP ID：</label>
              <div class="am-u-sm-9">
                <input type="text" name="app_id"  value="{{ old('app_id') }}" />
              </div>
            </div>

            <div class="am-form-group">
              <label for="app_secret" class="am-u-sm-3 am-form-label">APP SECRET：</label>
              <div class="am-u-sm-9">
                <input type="text" name="app_secret"  value="{{ old('app_secret') }}"/>
              </div>
            </div>
            
            <div class="am-form-group">
              <label for="encoding_aes_key" class="am-u-sm-3 am-form-label">消息加密(EncodingAESKey)：</label>
              <div class="am-u-sm-9">
                <input type="text" name="encoding_aes_key" value="{{ old('encoding_aes_key') }}"/>
              </div>
            </div>

            <div class="am-form-group">
              <label for="url_type" class="am-u-sm-3 am-form-label">对接方式：</label>
              <div class="am-u-sm-9">
        
                 <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="1" name="url_type" @if(old('url_type')==1) checked="checked" @endif >微信授权
                  </label>
                </div>
                <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="2" name="url_type" @if(old('url_type')==2) checked="checked" @endif>第3方授权
                  </label>
                </div>

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