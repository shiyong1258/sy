/**
 * Created by admin on 2017/2/9.
 */
$(function(){
    //������
    $("#inputSearch").on("focus",function(){
        if(this.value==this.defaultValue){
            this.value="";
        }
    }).on("blur",function(){
        if(this.value==""){
            this.value=this.defaultValue;
        }
    })
    //�����˵�
    $("#nav li").hover(function(){
            $(this).children(".jnNav").show()
        },function(){
            $(this).children(".jnNav").hide()
        }
    )
    //hot
    $(".promoted").append("<span class='hot'></span>")
    //�ֲ�ͼ
    $("#jnImageroll div a").on("mouseover",function(){
        $(this).addClass("chos").siblings().removeClass("chos");
        //$("#JS_imgWrap img").eq($(this).index()).show().siblings().hide()
        $("#JS_imgWrap img").eq($(this).index()).show().parent().siblings().children().hide();
    })
    //�¸��ֲ�ͼ
    $("#jnBrandTab li").on("click",function(){
        $(this).addClass("chos").siblings().removeClass("chos");
       // $("#jnBrandList li").;
        index=$(this).index();
        var width=$("#jnBrandList li").outerWidth();
        rollWidth=width*4;
        $("#jnBrandList").animate({
            left:-rollWidth*index
        },1000)
    })
    //��껮�������ݽ���
     //$content=$(this).html();
     // console.log($content);
     // $(this).append("<span>$content=$(this).html()</span>");
     $("#jnNoticeInfo li a").hover(function(e){
         this.myTitle=this.title;//��ֹĬ����Ϊ
         this.title="";
         var $div=$("<div id='remove'></div>")
         $div.appendTo($("body")).html(this.myTitle).offset({ left: e.pageX+15,top: e.pageY+15}).show('fast');
     },function(){
         $("#remove").remove();
         this.title=this.myTitle;
     }).on("mousemove",function(e){
         $("#remove").offset(
             {
                 left: e.pageX+15,
                 top: e.pageY+15
             }
         )
     })
    //����
    $("#skin li").on("click",function(){
        //var skin=$(this).attr()
        $(this).addClass("selected").siblings().removeClass("selected");
        $("#cssfile").attr("href","styles/skin/"+ this.id+".css")
    })
})

//     this.myTitle=this.innerHTML;
//    this.title="";
//    //console.log(this.myTitle);
//    var $div=$("<div id='remove'></div>");
//    $div.appendTo($("body")).html(this.myTitle).offset({
//        left: e.pageX + 15,
//        top: e.pageY + 15
//    }).show("fast");
//}),function(){
//    $("#remove").remove()
