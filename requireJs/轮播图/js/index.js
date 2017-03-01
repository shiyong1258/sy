/**
 * Created by admin on 2017/2/20.
 */
require(['jquery','lb'],function($,Lb){
       var car1=new Lb();
       car1.init({
           selector:'#content1',
           'button-style':'circle',
           speed:1000,
           imgData:['img/1.jpg','img/2.jpg','img/3.jpg']
       })
});