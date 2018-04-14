@extends('admin.admin')
@section('title','公众号修改')
@section('dataType','generalComponents')
@section('content')
@include('layouts.message')
<div class="tpl-portlet-components">
    <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 公众号修改
                    </div>
                </div>
<div class="tpl-block ">
                    <div class="am-g tpl-amazeui-form">
                        <div class="am-u-sm-12 am-u-md-9">
                          <form class="am-form am-form-horizontal" action="{{ route('account.update',$account->id) }}" method="post">
          <input type="hidden" name="_method" value="PUT">
          {{csrf_field()}}
            <div class="am-form-group">
              <label for="account_type" class="am-u-sm-3 am-form-label">帐号类型：</label>
              <div class="am-u-sm-9">
                <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="1" name="account_type" @if($account->account_type==1) checked="checked" @endif >订阅号
                  </label>
                </div>
                 <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="2" name="account_type" @if($account->account_type==2) checked="checked" @endif>服务号
                  </label>
                </div>
              </div>
            </div>

            <div class="am-form-group">
              <label for="wechat_name" class="am-u-sm-3 am-form-label">公众号名称:</label>
              <div class="am-u-sm-9">
                <input type="text" name="wechat_name" value="{{ $account->wechat_name }}" />
              </div>
            </div>

            <div class="am-form-group">
              <label for="app_id" class="am-u-sm-3 am-form-label">APP ID：</label>
              <div class="am-u-sm-9">
                <input type="text" name="app_id"  value="{{ $account->app_id }}" />
              </div>
            </div>

            <div class="am-form-group">
              <label for="app_secret" class="am-u-sm-3 am-form-label">APP SECRET：</label>
              <div class="am-u-sm-9">
                <input type="text" name="app_secret"  value="{{ $account->app_secret }}"/>
              </div>
            </div>
            
            <div class="am-form-group">
              <label for="encoding_aes_key" class="am-u-sm-3 am-form-label">消息加密(EncodingAESKey)：</label>
              <div class="am-u-sm-9">
                <input type="text" name="encoding_aes_key" value="{{ $account->encoding_aes_key }}"/>
              </div>
            </div>

            <div class="am-form-group">
              <label for="url_type" class="am-u-sm-3 am-form-label">对接方式：</label>
              <div class="am-u-sm-9">
        
                 <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="1" name="url_type" @if($account->url_type==1) checked="checked" @endif >微信授权
                  </label>
                </div>
                <div class="am-radio-inline">
                  <label>
                    <input type="radio" value="2" name="url_type" @if($account->url_type==2) checked="checked" @endif>第3方授权
                  </label>
                </div>

              </div>
            </div>


            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="submit" class="am-btn am-btn-primary">保存提交</button>
                <button type="button" class="am-btn am-btn-secondary am-radius" onclick="javascript:window.open('{{ route('account.index') }}','_self')"><i class="am-icon-mail-reply"></i> 返回列表</button>
              </div>
            </div>
          </form>
                        </div>
                    </div>
                </div>
</div>
@endsection