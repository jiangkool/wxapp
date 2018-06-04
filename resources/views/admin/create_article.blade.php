@extends('admin.admin')
@section('title','新增文档')
@section('dataType','generalComponents')
@section('content')
<link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@include('layouts.message')
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 新增文档
                    </div>
                </div>

                <div class="tpl-block">

                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" action="{{ route('article.store') }}" method="post">
                                {{csrf_field()}}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="title" id="title" placeholder="标题" value="{{ old('title') }}" required="required" placeholder="请输入标题文字">
                                        <small>请填写标题文字10-20字左右。</small>
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">栏目 <span class="tpl-form-line-small-title">Category</span></label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{searchBox: 1}" name="category_id">
  @foreach($categorys as $category)
                <option value="{{ $category->id }}" @if($category->id==old('category_id')) selected @endif>{{ $category->category_name }}</option>
              @endforeach
</select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label">SEO关键字 <span class="tpl-form-line-small-title">SEO</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="输入SEO关键字">
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
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file" id="uploader-demo">
                                            <div class="tpl-form-file-img" >
                                                <img id="file" src="/assets/img/no_img.jpg" width="200" height="100" />
                                            </div>
                                            <div type="button" id="filePicker">
                                            <i class="am-icon-cloud-upload"></i> 添加封面图片</div>
                                            <input id="thumb" name="thumb" type="hidden" />
                                        </div>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">是否推荐</label>
                                    <div class="am-u-sm-9">
                                        <div class="tpl-switch">
                                            <input type="checkbox" name="attr" value="1" class="ios-switch bigswitch tpl-switch-btn" />
                                            <div class="tpl-switch-btn-view">
                                                <div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">文章内容</label>
                                    <div class="am-u-sm-9">
                                        <script id="container" name="body" type="text/plain"></script>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
            <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
            <script type="text/javascript" src="/webuploader/webuploader.js"></script>
            <script>
                 var ue = UE.getEditor('container');
                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/webuploader/Uploader.swf',
                    server: "{!! route('uploadfile') !!}",
                    pick: '#filePicker',
                    accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                    },
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file ,response) {
                $("#file").attr( 'src', response.fileUrl );
                $success=$('.success');
                if ( !$success.length ) {
                    $('<div class="success">上传成功！</div>').appendTo( $(".tpl-form-file-img") );
                }
                
                $("#thumb").val(response.fileUrl);
            });

            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file ) {
                $error=$('.error');
                // 避免重复创建
                if ( !$error.length ) {
                    $error = $('<div class="error">上传失败！</div>').appendTo( $(".tpl-form-file-img") );
                }

                $error.text('上传失败');
            });



            </script>
@endsection