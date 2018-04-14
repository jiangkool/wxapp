@extends('layouts.admin')

@section('title','发布信息')

@section('content')
<link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
<div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">发布信息</strong> / <small>Publish</small></div>
      </div>

      <hr/>

      <div class="am-g">
        @include('layouts.message')
        <div class="am-u-sm-12 am-u-md-8">
          <form class="am-form am-form-horizontal" action="{{ route('article.store') }}" method="post">
          {{csrf_field()}}

          <div class="am-form-group">
              <label for="category_id" class="am-u-sm-3 am-form-label">选择栏目：</label>
              <div class="am-u-sm-9">
              <select id="doc-select-1" name="category_id">
              @foreach($categorys as $category)
                <option value="{{ $category->id }}" @if($category->id==old('category_id')) selected @endif>{{ $category->category_name }}</option>
              @endforeach
              </select>
              <span class="am-form-caret"></span>
              </div>
            </div>

           <div class="am-form-group">
              <label for="title" class="am-u-sm-3 am-form-label">标题：</label>
              <div class="am-u-sm-9">
                <input type="text" name="title" id="title" placeholder="标题" value="{{ old('title') }}" required="required">
              </div>
            </div>
<div class="am-panel-group am-u-sm-9 am-u-sm-offset-3" id="accordion">
  <div class="am-panel am-panel-default">
    <div class="am-panel-hd">
      <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-1'}">
        项目属性
      </h4>
    </div>
    <div id="do-not-say-1" class="am-panel-collapse am-collapse">
      <div class="am-panel-bd">
        <div class="am-form-group">
              <label for="new_price" class="am-u-sm-3 am-form-label">现价：</label>
              <div class="am-u-sm-3">
                <input type="text" name="new_price" id="new_price" placeholder="现价" value="{{ old('new_price')?:'0.00' }}">
              </div>
                <label for="old_price" class="am-u-sm-3 am-form-label">原价：</label>
              <div class="am-u-sm-3">
              <input type="text" name="old_price" id="old_price" placeholder="原价" value="{{ old('old_price')?:'0.00' }}">
              </div>
            </div>
      </div>
    </div>
  </div>
  <div class="am-panel am-panel-default">
    <div class="am-panel-hd">
      <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-2'}">
        专家属性
      </h4>
    </div>
    <div id="do-not-say-2" class="am-panel-collapse am-collapse">
      <div class="am-panel-bd">
        <div class="am-form-group">
              <label for="zj_zc" class="am-u-sm-2 am-form-label" style="padding:0">职称：</label>
              <div class="am-u-sm-3" style="padding:0">
                <input type="text" name="zj_zc" id="zj_zc" placeholder="职称" value="{{ old('zj_zc') }}">
              </div>
                <label for="cz_time" class="am-u-sm-4 am-form-label">出诊时间：</label>
              <div class="am-u-sm-3" style="padding:0">
              <input type="text" name="cz_time" id="cz_time" placeholder="出诊时间" value="{{ old('cz_time') }}">
              </div>
              <div style="width: 100%;height: 15px;clear: both;"></div>
              <label for="zj_sc" class="am-u-sm-2 am-form-label" style="padding:0">擅长：</label>
              <div class="am-u-sm-10" style="padding:0">
                <input type="text" name="zj_sc" id="zj_sc" placeholder="擅长" value="{{ old('zj_sc') }}">
              </div>
            </div>
      </div>
    </div>
  </div>

</div>
            
            
            <div class="am-form-group">
              <label for="thumb" class="am-u-sm-3 am-form-label">缩略图：</label>
              <div class="am-u-sm-9">
            @include('layouts.upload')
              </div>
            </div>
             <div class="am-form-group">
              <label for="body" class="am-u-sm-3 am-form-label">内容：</label>
              <div class="am-u-sm-9">
                <script id="container" name="body" type="text/plain"></script>
              </div>
            </div>
            <div class="am-form-group">
            <label for="attr" class="am-u-sm-3 am-form-label">属性：</label>
            <label class="am-radio-inline">
            <input type="radio" name="attr" value="1"> 推荐
            </label>
            <label class="am-radio-inline">
            <input type="radio" name="attr" value="0" checked="checked"> 未推荐
            </label>
            <label class="am-radio-inline">
            <input type="radio" name="attr" value="2" > 头条
            </label>
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
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>

    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        jQuery(function() {
    var $ = jQuery,
        $list = $('#fileList'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: '/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: '/webuploader/fileupload.php',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<input type="hidden" name="thumb" id="thumb" value="/upload/thumb/'+file.name+'" />'+
                '</div>'
                ),
            $img = $li.find('img');

        $list.append( $li );

        // 创建缩略图
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).addClass('upload-state-done');
    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });
});
  </script>
@endsection