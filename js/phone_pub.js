
/*
* myFocus焦点图基本库代码开始
*/
var myFocus={
$:function(id){return document.getElementById(id);},
$$:function(tag,obj){return (typeof obj=='object'?obj:this.$(obj)).getElementsByTagName(tag);},
$li:function(obj,n){return this.$$('li',this.$$('ul',obj)[n])},
linear:function(t,b,c,d){return c*t/d + b;},
easeIn:function(t,b,c,d){return c*(t/=d)*t*t*t + b;},
easeOut:function(t,b,c,d){return -c*((t=t/d-1)*t*t*t - 1) + b;},
easeInOut:function(t,b,c,d){return ((t/=d/2) < 1)?(c/2*t*t*t*t + b):(-c/2*((t-=2)*t*t*t - 2) + b);},
style:function(obj,style){return (+[1,])?window.getComputedStyle(obj,null)[style]:obj.currentStyle[style];},//getStyle简化版
opa:function(obj,v){//取得或设置对象透明度,默认100
if(v!=undefined) {v=v>100?100:(v<0?0:v); obj.style.filter = "alpha(opacity=" + v + ")"; obj.style.opacity = (v / 100);}
else return (!+[1,])?((obj.filters.alpha)?obj.filters.alpha.opacity:100):((obj.style.opacity)?obj.style.opacity*100:100);
},
animate:function(obj,prop,val,spd,type,fn){
var opa=prop=='opacity'?true:false;
if(opa&&obj.style.display=='none'){obj.style.display='';this.opa(obj,0);}
var t=0,b=opa?this.opa(obj):parseInt(this.style(obj,prop)),c=val-b,d=spd||50,st=type||'easeOut',m=c>0?'ceil':'floor';
if(obj[prop+'Timer']) clearInterval(obj[prop+'Timer']);
obj[prop+'Timer']=setInterval(function(){
if(opa&&t<d){myFocus.opa(obj,Math[m](myFocus[st](++t,b,c,d)));}
else if(!opa&&t<d){obj.style[prop]=Math[m](myFocus[st](++t,b,c,d))+'px';}
else {if(opa&&val==0){obj.style.display='none'}clearInterval(obj[prop+'Timer']);fn&&fn.call(obj);}
},10);return this;
},
fadeIn:function(obj,speed,fn){this.animate(obj,'opacity',100,speed==undefined?20:speed,'linear',fn);return this;},
fadeOut:function(obj,speed,fn){this.animate(obj,'opacity',0,speed==undefined?20:speed,'linear',fn);return this;},
slide:function(obj,params,speed,easing,fn){for(var p in params) this.animate(obj,p,params[p],speed,easing,fn);return this;},
stop:function(obj){//停止所有运动函数
var animate=['left','right','top','bottom','width','height','opacity'];
for(var i=0;i<animate.length;i++) if(obj[animate[i]+'Timer']) clearInterval(obj[animate[i]+'Timer']);
return this;
},
initCSS:function(p){
var css=[],oStyle = document.createElement('style');oStyle.type='text/css';
if(p.width){css.push('.'+p.style+' *{margin:0;padding:0;border:0;list-style:none;}.'+p.style+'{position:relative;width:'+p.width+'px;height:'+p.height+'px;overflow:hidden;font:12px/1.5 Verdana,Geneva,sans-serif;background:#fff;}.'+p.style+' .loading{position:absolute;z-index:9999;width:100%;height:100%;color:#666;text-align:center;padding-top:'+0.3*p.height+'px;background:#fff}.'+p.style+' .swt,.'+p.style+' .swt li{width:'+p.width+'px;height:'+p.height+'px;overflow:hidden;}.'+p.style+' .txt li,.'+p.style+' .txt li span,.'+p.style+' .txt-bg{width:'+p.width+'px;height:'+p.txtHeight+'px;line-height:'+p.txtHeight+'px;overflow:hidden;}')}
if(oStyle.styleSheet){oStyle.styleSheet.cssText=css.join('');} else {oStyle.innerHTML=css.join('');}
var oHead = this.$$('head',document)[0];oHead.insertBefore(oStyle,oHead.firstChild);
},
setting:function(par){
if(window.attachEvent){(function(){try{myFocus.$(par.id).className=par.style;myFocus.initCSS(par);}catch(e){setTimeout(arguments.callee,0);}})();window.attachEvent('onload',function(){myFocus[par.style](par)});}
　　		else{document.addEventListener("DOMContentLoaded",function(){myFocus.$(par.id).className=par.style;myFocus.initCSS(par);},false);window.addEventListener('load',function(){myFocus[par.style](par)},false);}
},
addList:function(obj,cla){//生成HMTL,cla为生成列表的class,其中封装有:cla='txt'(生成alt文字),cla='num'(生成按钮数字),cla='thumb'(生成小图)
var s=[],n=this.$li(obj,0).length,num=cla.length;
for(var j=0;j<num;j++){
s.push('<ul class='+cla[j]+'>');
for(var i=0;i<n;i++){s.push('<li>'+(cla[j]=='num'?('<a>'+(i+1)+'</a>'):(cla[j]=='txt'?this.$li(obj,0)[i].innerHTML.replace(/\>(.|\n|\r)*?(\<\/a\>)/i,'>'+(this.$$('img',obj)[i]?this.$$('img',obj)[i].alt:'')+'</a>'):(cla[j]=='thumb'?'<img src='+(this.$$('img',obj)[i].getAttribute("thumb")||this.$$('img',obj)[i].src)+' />':'')))+'<span></span></li>')};
s.push('</ul>');
}; obj.innerHTML+=s.join('');
},
switchMF:function(fn1,fn2){
return "box.removeChild(this.$$('div',box)[0]);var run=function(idx){("+fn1+")();if (index == n - 1) index = -1;var next = idx != undefined ? idx: index + 1;("+fn2+")();index=next;};run(index);if(par.auto!==false) var auto=setInterval(function(){run()},t);box.onmouseover=function(){if(auto) clearInterval(auto);};box.onmouseout=function(){if(auto) auto=setInterval(function(){run()},t);}"
},
bind:function(arrStr,type,delay){
return "for (var j=0;j<n;j++){"+arrStr+"[j].index=j;if("+type+"=='click'){"+arrStr+"[j].onmouseover=function(){if(this.className!='current') this.className='hover'};"+arrStr+"[j].onmouseout=function(){if(this.className=='hover') this.className=''};"+arrStr+"[j].onclick=function(){if(this.index!=index) run(this.index)};}else if("+type+"=='mouseover'){"+arrStr+"[j].onmouseover=function(){var self=this;if("+delay+"==0){if(!self.className) run(self.index)}else "+arrStr+".d=setTimeout(function(){if(!self.className) run(self.index)},"+(delay==undefined?100:delay)+")};"+arrStr+"[j].onmouseout=function(){clearTimeout("+arrStr+".d)};}else{alert('myFocus 不支持这样的事件 \"'+"+type+"+'\"');break;}}"
},
extend:function(fnObj){for(var p in fnObj) this[p]=fnObj[p];}
};
/*
* myFocus焦点图基本库代码结束
* 下面是各款基于myFocus库制作的焦点图风格皮肤，可自行按需选择
* myFocus焦点图库及皮肤可自由使用，保留作者相关信息即可，谢谢支持！^^
*/
myFocus.extend({
mF_tab:function(par){
var box=this.$(par.id);//定义焦点图盒子
this.$$('ul',box)[1].innerHTML='<li><ul class=swt>'+this.$$('ul',box)[1].innerHTML+'</ul></li>';
var btn=this.$li(box,0),swt=this.$$('ul',box)[2];//定义焦点图元素
var index=par.index||0,n=btn.length,t=par.time*1000;//运行时相关参数
//CSS
this.$$('ul',box)[1].style.cssText='width:'+par.width+'px;height:'+par.height+'px;';
swt.style.width=n*par.width+'px';
box.style.cssText='width:'+(par.width+2)+'px;height:'+(par.height+29)+'px;'
//PLAY
eval(this.switchMF(function(){
btn[index].className='';
},function(){
myFocus.slide(swt,{left:-(next*par.width)},20,'easeInOut')
btn[next].className='current';
}))
eval(this.bind('btn','par.trigger',par.delay));
}
})
myFocus.setting({
style:'mF_tab',//风格样式
id:'myFocus',//绑定ID
trigger:'click',//tab切换模式：'click'(点击切换)/'mouseover'(悬停切换)
auto:false,//是否自动切换，true为自动，false为非自动
time:2,//自动切换模式时的切换时间间隔
width:424,//宽(内容区)
height:61//高(内容区)
});
