/**
 * Created by admin on 2017/2/19.
 */
require(['jquery','dialog'],function($,dialog){
       $("#btn").on("click",function(){
           dialog.open({
               width:800,
               height:500,
               title:"never give up",
               content:"哈哈哈"
           });
           dialog.close();

       });
       //$(".right").on("click",function(){
       //    dialog.close();
       //})
});
