(function($) {
  'use strict';

  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
      $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    });
  });
})(jQuery);


//全选
var isCheckAll = false;  
function swapCheck() {  
    if (isCheckAll) {  
        $("input[type='checkbox']").each(function() {  
            this.checked = false;  
        });  
        isCheckAll = false;  
    } else {  
        $("input[type='checkbox']").each(function() {  
            this.checked = true;  
        });  
        isCheckAll = true;  
    }  
}  
$(function(){

//批量删除permissions
$("#del-ids").click(function(){
    var ids='';
    $(".am-form tbody :checked").each(function(){
        ids=Number($(this).val())+','+ids;
    })
    console.log(ids);
   window.location.href="permission/"+ids+"/delete";
})

function getParam(paramName) { 
    paramValue = "", isFound = !1; 
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
    } 
    return paramValue == "" && (paramValue = null), paramValue 
} 


$('.btn-loading-submit').click(function () {
  var $btn = $(this)
  $btn.button('loading');
    setTimeout(function(){
      $btn.button('reset');
  }, 5000);
});


})//end jquery