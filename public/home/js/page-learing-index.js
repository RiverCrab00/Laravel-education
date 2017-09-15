/****/
// 首页导航左侧导航显隐控制
$(document).scroll(function(){
    var scTop = $(document).scrollTop()
    if(scTop >= 550){
         $(".index-cont-nav").show();   
    }else{
         $(".index-cont-nav").hide();   
    }
})