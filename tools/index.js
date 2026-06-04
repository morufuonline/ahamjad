<!--
var c = 1;
var d = 1;
var img_height = 0;
var slidesLength = $("div.animation div.holder div").length;

function adjustWebPage(){
var widthWin = $(window).width() || window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
if(widthWin <= 850){
$("div.top_links ul.top_links_ul").hide("fold");
$("a.toggle").show("fold");
}else{
$("a.toggle").hide("fold");
$("div.top_links ul.top_links_ul").show("fold");
}
}

function prevNextDetect(){
if(c==1){
$(".previousSpan").html(slidesLength);
$(".nextSpan").html("2");
}else if(c==slidesLength){
$(".previousSpan").html(slidesLength-1);
$(".nextSpan").html("1");
}else{
$(".previousSpan").html(c-1);
$(".nextSpan").html(c+1);
}
}

function nextPicture(){
$("div.animation").css({"height":$("div.animation div#ani1 img").height()});
c++;
if(c == slidesLength+1){c = 1;}
img_height = $("div.animation div#ani"+c+" img").height();
$("div.holder").animate({"margin-top":img_height * - (c-1)},1000,function(){prevNextDetect();});
}

function previousPicture(){
$("div.animation").css({"height":$("div.animation div#ani1 img").height()});
c=c-1;
if(c==0){c=slidesLength;}

img_height = $("div.animation div#ani"+c+" img").height();
$("div.holder").animate({"margin-top":img_height * - (c-1)},1000,function(){prevNextDetect();});
}
//////
slideShowInterval = setInterval("nextPicture()", 7000);
$(".slideHover a.previous, .slideHover a.next").hover(function(){
clearInterval(slideShowInterval);
},function(){
slideShowInterval = setInterval("nextPicture()", 7000);
});
///////

$.fn.animateBG = function(x, y, speed, def) {
    var pos = this.css('background-position').split(' ');
    this.x = 0,
    this.y = def;
    $.Animation( this, {
        x: x,
        y: y
      }, { 
        duration: speed
      }).progress(function(e) {
          this.css('background-position', e.tweens[0].now+'px '+e.tweens[1].now+'px');
    });
    return this;
}

$(document).ready(function(){

prevNextDetect();
$("div.banner ul.top_links_ul li a").hover(function(){
$(this).css({"opacity":"0.7"});
},function(){
$(this).css({"opacity":"1.0"});	
});

$("div.animation").css({"height":$("div.animation div#ani1 img").height()});
$("div.holder").css({"height":$("div.animation div#ani1 img").height() * slidesLength, "margin-top":$("div.animation div#ani1 img").height() * - (c-1)});
$("div.animation div").show();

$("div.leftContent ul li a, div.footer ul li a").not(".links_header").not(".current").hover(function(){
$(this).animateBG(0, -42, 1000, 2);
},function(){
$(this).animateBG(0, 2, 1000, -42);
});

$(window).resize(function (){
$("div.animation").css({"height":$("div.animation div#ani1 img").height()});
$("div.holder").css({"height":$("div.animation div#ani1 img").height() * slidesLength, "margin-top":$("div.animation div#ani1 img").height() * - (c-1)});
});

});
//-->