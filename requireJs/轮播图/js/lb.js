/**
 * Created by admin on 2017/2/20.
 */
define(['jquery'],function($){
    function Lb(){
        this.defaultVal={
            'button-style':'circle',
            speed:800
        }
        this.$container=$('<div class="container"></div>');
        this.$content=$('<div class="content"></div>');
        this.$list=$('<div class="list"></div>');
        this.$tab=$('<div class="tab"></div>');
        this.$left=$('<span class="left">&lt</span>');
        this.$right=$('<span class="right">&gt</span>');
    }
      Lb.prototype.init=function(options){
          var that=this;
          var iNow=0;
          $.extend(this.defaultVal,options);
          this.$container.append(this.$content).append(this.$list).append(this.$tab);
          for(var i=0;i<this.defaultVal.imgData.length;i++){
              this.$content.append('<img class="'+(i==0?'selected':'')+'" src="'+this.defaultVal.imgData[i]+'"/>');
              this.$list.append('<li class="'+(i==0?'selected':'')+'">'+(i+1)+'</li>');
          }
          this.$tab.append(this.$left).append(this.$right);
          //console.log(this.defaultVal.imgData);'+this.defaultVal.imgData[i]+'
          $(this.defaultVal.selector).append(this.$container);
          $(".list li").on("click",function(){
             changeImg($(this).index());
          });
          function changeImg(idx){
              $("li",that.$list).eq(idx).addClass("selected").siblings().removeClass("selected");
              $("img",that.$content).eq(idx).addClass("selected").siblings().removeClass("selected");
          }
          $(".left").on("click",function(){
              iNow--;
              if(iNow==-1){
                  iNow=that.defaultVal.imgData.length-1;
              }
              changeImg(iNow);
          });
          $(".right").on("click",function(){
              iNow++;
              if(iNow==that.defaultVal.imgData.length){
                  iNow=0;
              }
              changeImg(iNow);
          });
          var timer;
          function run(){
              timer= setInterval(function(){
                  $(".right").trigger("click")
              },that.defaultVal.speed);
          }
          run();
          $(".container").hover(function(){
              clearInterval(timer);
          },function(){
              run();
          })


      };
    return Lb;
});
