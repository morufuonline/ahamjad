<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();
include "my_connection.php";

function detectCurrUserBrowser($a,$b,$c){
$msie = stripos($_SERVER["HTTP_USER_AGENT"], "msie") ? true : false;
if($msie){
$msiePosition = stripos($_SERVER["HTTP_USER_AGENT"], "msie");
$msiePositionNew = $msiePosition+5;
$versionNumber = substr($_SERVER["HTTP_USER_AGENT"],$msiePositionNew,1);
if($versionNumber <= $c){
echo $a;
}
else{
echo $b;
}
}
else{
echo $b;
}
}
?>

<!DOCTYPE html>

<?php
if(basename($_SERVER["PHP_SELF"]) == "index.php"){
?>
<style>
<!--
div.scroll_div{
position:fixed; 
width:100%; 
z-index:1000; 
background:#fff;
border-bottom:3px solid #ddd;
display:none;
}
div.inner_scroll_div{
width:100% !important; 
max-width:1000px; 
margin:auto;
}
div.inner_scroll_div ul{
list-style:none;
line-height:45px;
float:right;
}
div.inner_scroll_div ul li{
display:inline;
}
div.inner_scroll_div ul li a{
border:1px solid #900;
color:#900;
padding:5px;
font-weight:bold;
}
div.inner_scroll_div ul li a:hover, div.inner_scroll_div ul li a.active{
color:#fff;
background:#900;
}

div.rightContent div.animation{
overflow:hidden;
}

@media(min-width:665px){
div.rightContent div.animation{
min-height:300px;
}
}
div.rightContent div.animation div.hover div{
display:none;
clear:both;
}
div.rightContent div.animation img{
display:block;
clear:both;
width:100%;
height:auto;
}
div.home_content1, div.home_content2{
overflow:hidden;
border:1px solid #666;
display:block;
margin:10px;
padding:10px;
}
div.home_content1, div.home_content2, div.home_content1 img, div.home_content2 img, div.inner_scroll_div ul li a{
border-radius:5px; 
-moz-border-radius:5px; 
-webkit-border-radius:5px;
-khtml-border-radius:5px;
}
div.home_content1 img, div.home_content2 img{
height:100px;
width:100px;
margin:5px;
}
div.home_content1 img{
float:left;
}
div.home_content2 img{
float:right;
}
a.read_more{
color:#0b0;
}
a.read_more:hover{
text-decoration:underline;
color:#080;
}
div.home_content1 ul li{
margin-left:125px;
}
@media(max-width:370px){
div.home_content1 ul li.first_break{
margin-left:15px;
}
}
@media(max-width:500px){
div.home_content1 ul li.second_break{
margin-left:15px;
}
}

.toggleGroup{
position:relative;
z-index:10;
margin:auto;
}

.slideHover{
display:block;
position:absolute;
width:100%;
float:left;
top:55px;
left:0px;
z-index:8;
margin:5px;
margin-top:55px;
}
.slideHover a.previous,.slideHover a.next{
padding:10px;
font-weight:bold;
font-size:18px;
background:url(images/disp_bg.png);
color:#fff;
top:0px;
margin:5px;
border-radius:5px; 
-moz-border-radius:5px; 
-webkit-border-radius:5px;
-khtml-border-radius:5px;
}
.slideHover a.previous:hover,.slideHover a.next:hover{
background:#bbb;
}
.slideHover a.previous{
float:left;
left:10px;
margin-left:10px;
}
.slideHover a.next{
float:right;
right:20px;
margin-right:20px;
}
.slideHover span{
color:#fff;
font-weight:bold;
font-size:18px;
}
-->
</style>

<div class="scroll_div">

<div class="inner_scroll_div"><a href="index.php" style="position:absolute;"><img src="images/scroll_logo.png" /></a>
<ul class="scroll_link">
<li><a href="#about_us">About Us</a></li>
<li><a href="#customer_service">Customer Service</a></li>
<li><a href="#contact_us">Contact Us</a></li>
<li><a href="#inquiry">Inquiry</a></li>
</ul>
</div>

</div>

<?php
}
?>

<html lang="en-US" dir="ltr">
<head>
<base href="<?php directory(); ?>" target="_top">
<meta charset="UTF-8" />
<meta name="keywords" content="<?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?"Home":str_replace("_"," ",basename($_SERVER["PHP_SELF"],".php")) ?>, Ahamjad Nigeria Limited" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?"Home":str_replace("_"," ",basename($_SERVER["PHP_SELF"],".php")); echo " - Ahamjad Nigeria Limited"; ?></title>
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="icon" href="images/favicon.gif" type="image/gif">
<link type="text/css" rel="stylesheet" href="tools/style.css" />
<script src="tools/jquery.js" type="text/javascript"></script>
</head>

<body>

<?php detectCurrUserBrowser('<table width="100%"><tr><td>','',7); ?>

<div class="bodyDiv">

<div class="bannerContainer"> 

<div class="banner" id="bannerID">
<a href="index.php"><img src="images/logo.gif" class="logo" /></a>
<ul class="social">
<li><a href="javascript:void(0);"><img src="images/logos/linkedin_logo.jpg"></a></li>
<li><a href="javascript:void(0);"><img src="images/logos/facebook_logo.jpg"></a></li>
<li><a href="javascript:void(0);"><img src="images/logos/googleplus_logo.jpg"></a></li>
<li><a href="javascript:void(0);"><img src="images/logos/twitter_logo.jpg"></a></li>
</ul>

<ul class="top_links_ul" id="top_links_ul">
<li><a href="index.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?" class=\"current\"":""; ?>>Home</a></li>
<li><a href="privates/About_Us.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "About_Us.php")?" class=\"current\"":""; ?>>About Us</a></li>
<li><a href="privates/Our_Products.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "Our_Products.php")?" class=\"current\"":""; ?>>Our Products</a></li>
<li><a href="privates/Customers_Relationship.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "Customers_Relationship.php")?" class=\"current\"":""; ?>>Customers Relationship</a></li>
<li><a href="privates/Contact_Us.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "Contact_Us.php")?" class=\"current\"":""; ?>>Contact Us</a></li>
<li><a href="privates/Inquiry.php"<?php echo (basename($_SERVER["PHP_SELF"]) == "Inquiry.php")?" class=\"current\"":""; ?>>Inquiry</a></li>
</ul>

</div>
</div>


<div class="contentContainer">

<div class="leftContent">
<ul class="leftContentLinks">
<li>
<a href="javascript:void(0);" class="links_header">PRODUCTS</a>
<a href="privates/products/Mild_Steel_Angle_Iron.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Mild_Steel_Angle_Iron.php"){echo 'class="current"';} ?>>Mild Steel Angle Iron</a>
<a href="privates/products/Flat_Bar.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Flat_Bar.php"){echo 'class="current"';} ?>>Flat Bar</a>
<a href="privates/products/Gratting_Wire.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Gratting_Wire.php"){echo 'class="current"';} ?>>Gratting Wire</a>
<a href="privates/products/Pipes.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Pipes.php"){echo 'class="current"';} ?>>Pipes</a>
<a href="privates/products/Plates.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Plates.php"){echo 'class="current"';} ?>>Plates</a>
<a href="privates/products/Beam.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Beam.php"){echo 'class="current"';} ?>>Beam</a>
<a href="privates/products/UPN_Channel.php" <?php if (basename($_SERVER["PHP_SELF"]) == "UPN_Channel.php"){echo 'class="current"';} ?>>UPN Channel</a>
<a href="privates/products/Z_Poline.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Z_Poline.php"){echo 'class="current"';} ?>>Z-Poline</a>
<a href="privates/products/Others.php" <?php if (basename($_SERVER["PHP_SELF"]) == "Others.php"){echo 'class="current"';} ?>>Others</a>
</li></ul>
</div>