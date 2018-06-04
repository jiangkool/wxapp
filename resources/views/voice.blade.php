<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>听，妈妈的话 朗读胎教音乐会</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/assets/css/amazeui.min.css">
<script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<style>
*{ margin:0; padding:0;}
body{min-width:320px; max-width:640px; margin:0 auto; background:#ffffff;font:14px Microsoft Yahei;color:#464646;}
.fm1{ position:relative; width:100%; float:left;}
.fm1 a{ width: 20%; left:8%; top:55%; position:absolute; color:#FFF; text-decoration:none; text-align:center;}
.fm1 a.fm1_a2{ left:40%;}
.fm1 a.fm1_a3{ left:72%;}
.fm1 a img{ width:80%; padding:10%;filter:alpha(opacity=80);  -moz-opacity:0.8;  -khtml-opacity: 0.8;  opacity: 0.8;-webkit-user-select:none;-webkit-touch-callout:none; }
.fm1 a:hover img,.fm1 a:active img,.fm1 a.on img,.fm1 a img.on{ width:100%; padding:0;filter:alpha(opacity=100);  -moz-opacity:1;  -khtml-opacity: 1;  opacity: 1; }
.fm1 a i{font-size: 40px;color: #d05c91;width: 70px;height: 70px;border: 5px solid #d05c91;border-radius: 70px}

.fm1 a i.am-icon-music,.fm1 a i.am-icon-volume-up,.fm1 a i.on{color: #FFF;border-color: #FFF}
.fm1 a span{line-height: 35px}
</style>
</head>
<body>
<img src="/assets/images/ly_01.jpg" style="width:100%; float:left;" />
<div class="fm1">
<img src="/assets/images/ly_02.jpg" style="width:100%; float:left;" />
<a id="shiting" onClick="playVoice()"><i class="am-icon-play"></i><br><span>点击试听</span></a>
<a class="fm1_a2"  id="record"><i class="am-icon-microphone"></i><br><span>长按录音</span></a>
<a class="fm1_a3"  id="uploadv" onClick="uploadVoice()"><i class="am-icon-cloud-upload"></i><br><span>上传录音</span></a>
</div>
<img src="/assets/images/ly_03.jpg" style="width:100%; float:left;" />
<script src="/layer_m/layer.js"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $js->config(array('onMenuShareQQ', 'onMenuShareWeibo',"startRecord","stopRecord","onVoiceRecordEnd","playVoice","pauseVoice","stopVoice","onVoicePlayEnd","uploadVoice","downloadVoice"), false) !!});
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        var voice = {
            localId: []
        };
        var recorder;
        var btnRecord = $('#record');
        var startTime = 0;
        var recordTimer = 300;
        wx.ready(function () {

                    // 监听事件一开始就加载
                    wx.onVoicePlayEnd({
                        success: function (res) {
                        $("#shiting").find('i').removeClass("am-icon-volume-up").addClass("am-icon-play");
                        $("#shiting").find('span').text("点击试听");
                           layer.open({
                                        content: '播放完毕！',
                                        btn: '确定',
                                        shadeClose: false,
                             });
                        }
                    });
                   
                    btnRecord.on('touchstart', function (event) {
                        event.preventDefault();
                         $("#record").find('i').removeClass("am-icon-microphone").addClass("am-icon-volume-up");
                        startTime = new Date().getTime();
                        // 延时后录音，避免误操作
                        recordTimer = setTimeout(function () {
                                
                            wx.startRecord({
                                success: function () {
                                    $("#record").find('span').text("录音中...");
                                    wx.onVoiceRecordEnd({
                                        // 录音时间超过一分钟没有停止的时候会执行 complete 回调
                                        complete: function (res) {
                                        // 记录录音的临时ID
                                        voice.localId = res.localId;
                                        // 给出提示
                                        layer.open({content: '最多只能录制一分钟',time: 3 });
                                         uploadVoice();
                                        }
                                    });
                                },
                                cancel: function () {
                                    $("#record").find('span').text("长按录音");
                                    layer.open({
                                        content: '用户拒绝了录音授权',
                                        btn: '确定',
                                        shadeClose: false,
                                    });
                                }
                            });
                        }, 500);
                    }).on('touchend', function (event) {
                        event.preventDefault();
                        $("#record").find('i').removeClass("am-icon-volume-up").addClass("am-icon-microphone");
                        $("#record").find('span').text("长按录音");
                        // 间隔太短
                        if (new Date().getTime() - startTime < 500) {
                            startTime = 0;
                            // 不录音
                            clearTimeout(recordTimer);
                        } else { // 松手结束录音
                            wx.stopRecord({
                                success: function (res) {
                                  voice.localId = res.localId;
                                    // 上传到服务器
                                   // uploadVoice();
                               
                                },
                                fail: function (res) {
                                    //alert(JSON.stringify(res));
                                    layer.open({
                                        content: JSON.stringify(res),
                                        btn: '确定',
                                        shadeClose: false,
                                    });
                                }
                            });
                        }
                    });


    
                }); //wx.ready end


        function uploadVoice() {
            if (voice.localId!='') {
            $("#uploadv").find("i").addClass("on");
            $("#uploadv").find("span").text("上传中...");
            wx.uploadVoice({
                localId: voice.localId, // 需要上传的音频的本地ID，由stopRecord接口获得
                isShowProgressTips: 0, // 默认为1，显示进度提示
                success: function (res) {
                    voice.serverId = res.serverId;
                    $.ajax({
                        url: '/storeVoice',
                        type: 'post',
                        data: { serverId: res.serverId, id: {!! $uid !!} },
                        dataType: "json",
                        beforeSend:function(){
                           layer.open({
                            type: 2,
                            content: '正在上传，请稍候...',
                            shadeClose:false,
                            });
                        },
                        success: function (data) {
                            $("#uploadv").find("i").removeClass("on");
                            $("#uploadv").find("span").text("上传录音");
                            //alert(JSON.stringify(data))
                            layer.closeAll();
                            if (data.result == 1) {
                                layer.open({
                                    content: "录音上传完成！<br />长按识别关注官方微信公众号，<br />了解更多活动详情！<br /><div style='text-align:center;padding-top:20px'><img src=/assets/images/swt_y_03.jpg width=80 /></div>",//data.Message
                                    btn: '关闭',
                                    shadeClose: false,
                                });
                            }else {
                                layer.open({
                                    content: data.message,
                                    btn: '确定',
                                    shadeClose: false,
                                });
                            }
                        },
                        error: function (xhr, errorType, error) {
                           layer.closeAll()
                            layer.open({
                                content: error,
                                btn: '确定',
                                shadeClose: false,
                            });
                        }
                    });

                }
            });
            }else{
                layer.open({
                content: '请先录音！',
                btn: '确定',
                shadeClose: false,
              }); 
            }
        }
        
     /**
     * 播放音频
     */
    function playVoice()
    {
        if (voice.localId!='') {

            $("#shiting").find('i').removeClass("am-icon-play").addClass("am-icon-volume-up");
            $("#shiting").find('span').text("播放中...");
            wx.playVoice({
                localId: voice.localId
            });
        }else{
            layer.open({
                content: '请先录音！',
                btn: '确定',
                shadeClose: false,
              });
        }
    }  


</script>
</body>
</html>