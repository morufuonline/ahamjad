<?php include "includes/header.php"; ?>

<script>
<!--

var mobile = 0;
var dropOnce = 0;

$(document).ready(function () {

pageWidth();

    $(document).on("scroll", function(){onScroll(); doEffect();});
    
    //smoothscroll
    $('ul.scroll_link li a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('ul.scroll_link li a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
	
$(window).resize(function (){
pageWidth();
});
	
});

function pageWidth(){
var widthWin = $(window).width() || window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
if(widthWin < 700){
mobile = 1;
$("div.scroll_div").hide();
}else{
mobile = 0;
doEffect();
}
}

function onScroll(event){

var winHeiDocTop = window.scrollY || window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop;
if(mobile == 0){
if(winHeiDocTop < 250){$("div.scroll_div").hide();}else{
$("div.scroll_div").show();
}
}
    var scrollPos = $(document).scrollTop();
    $("ul.scroll_link li a").each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('ul.scroll_link li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}


function doEffect(){

var winHeiDoc1 = window.scrollY;
var winHeiDoc2 = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop;

if(winHeiDoc1 != undefined)
{
var winHeiDoc = winHeiDoc1;
if(winHeiDoc >= 250){
if(mobile == 0 && dropOnce == 0){
dropOnce = 1;
$("div.scroll_div").css({"display":"block","position":"fixed","left":"0px","z-index":"1000","-webkit-animation":"slide_down 1s","animation":"slide_down 1s"}).css({"top":"0px"});
var ts = setInterval(function(){ $("div.scroll_div").css({"-webkit-animation":"","animation":""}); }, 1000);
setTimeout(function(){clearInterval(ts);}, 1000);
}
}else{
dropOnce = 0;
$("div.scroll_div").css({"display":"none","position":"fixed","left":"0px","z-index":"1000","top":"-70px"});
}
}
else if(winHeiDoc2 != undefined)
{
var winHeiDoc = winHeiDoc2;
if(winHeiDoc >= 250){
if(mobile == 0){
$("div.scroll_div").css({"position":"absolute","top":winHeiDoc,"left":"0px","z-index":"1000"}).show("fold");
}
}else{
$("div.scroll_div").hide("slide");
}
}
}

//-->
</script>

<div class="rightContent">

<div class="toggleGroup">
<div class="slideHover">
<a title="Previous" href="Javascript:void(0);"  onclick="Javascript:previousPicture();" class="previous">&lt;&lt;&nbsp;<span class="previousSpan">&nbsp;</span></a>
<a title="Next" href="Javascript:void(0);"  onclick="Javascript:nextPicture();" class="next"><span class="nextSpan">&nbsp;</span>&nbsp;&gt;&gt;</a>
</div>
</div>

<div class="animation">
<div class="holder">
<div id="ani1" style="display:block;"><img src="images/products/angle.jpg" /></div>
<div id="ani2"><img src="images/products/flat_bar.jpg" /></div>
<div id="ani3"><img src="images/products/galvanized_pipe.jpg" /></div>
<div id="ani4"><img src="images/products/plate.jpg" /></div>
<div id="ani5"><img src="images/products/universal_beam.jpg" /></div>
</div>
</div>

<div class="home_content1" id="about_us">
<div class="home_content_header">About Us</div>
<img src="images/about_us.jpg" /><p>Ahamjad Nieria Limited is one of the big iron and steel companies in Nigeria. It was founded in 2005. Furthermore, it was incorporated in Nigeria under the Companies and Allied Matters Act 1990 in the year 2013 and since then, it has elevated to a very high level.</p> <p>We have customers and associates in Nigeria and international countries. We act with utmost good faith and integrity. That is why we maintain our goodwill with our costumers such that it increases the level of their patronage and believe in our company. Our product is globally demanded for and we supply as and when due.</p>
<a href="privates/About_Us.php" class="read_more">Read more...</a>
</div>

<div class="home_content2" id="customer_service">
<div class="home_content_header">Customer Service</div>
<img src="images/customer_service.jpg" />Ahamjad Nieria Limited deals in bulk purchase of iron materials in order to meet customers' demand. Since our year of commencement of business, customers good relationship has been our first target.
<a href="privates/Customers_Relationship.php" class="read_more">Read more...</a>
</p>
</div>

<div class="home_content1" id="contact_us">
<div class="home_content_header">Contact Us</div>
<img src="images/contact_us.jpg" />
<p>
<b>Branch Offices:</b><br>
<ul>
<li>S/L./L.G. shop 246, Ifesowapo Iron Market, Section "C", Line 2, Orile Iganmu, Lagos.</li>
<li class="first_break">S/L./L.G. shop 247, Ifesowapo Iron Market, Section "C", Line 2, Orile Iganmu, Lagos.</li>
<li class="second_break">S/L./L.G. shop 301, Ifesowapo Iron Market, Section "C", Line 2, Orile Iganmu, Lagos.</li>
</ul>
</p><p>
<b>Sales Rep. Tel. Nos.:</b><br>
+2348033898869, +2348099736396
</p>
<a href="privates/Contact_Us.php" class="read_more">Read more...</a>
</div>

<div class="home_content2" id="inquiry">
<div class="home_content_header">Inquiry</div>
<img src="images/inquiry.jpg" />Our utmost concern is to satisfy our customers.  This is why we make contact easy for them through our web site. Kindly click <a href="privates/Inquiry.php" class="read_more">HERE</a> to make inquiry about any of our products which include the following:
<ul style="margin-left:20px;">
<li>Beam</li>
<li>UPN Channel</li>
<li>Z-Poline</li>
<li>Others</li>
<li>Mild Steel Angle Iron</li>
<li>Flat Bar</li>
<li>Gratting Wire</li>
<li>Pipes</li>
<li>Plates</li>
<li>Etc.</li>
</ul>
</div>

</div>

<?php include "includes/footer.php"; ?>