<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();
include "../includes/my_connection.php";

if (isset($_GET['logout']))
{
unset($_SESSION["login"]);
unset($_SESSION["a"]);
unset($_SESSION["b"]);
redirect('read_messages.php');
}

if (isset($_POST['login']) && $_POST['login']=="ahamu")
{
$_SESSION["login"] = 1;
$_SESSION["checkValidity"] = 0;
redirect('read_messages.php');
}
if(isset($_POST["checkValidity"]))
{
$_SESSION["checkValidity"] = "";
$_SESSION["checkValidity"] = $_POST["checkValidity"];
$_SESSION["a"] = 1;
$_SESSION["b"] = 10;
}
if(isset($_GET["a"]) && isset($_GET["b"]))
{
$_SESSION["a"] = $_SESSION["b"] = "";
$_SESSION["a"] = $_GET["a"];
$_SESSION["b"] = $_GET["a"] + 9;
}elseif(!isset($_GET["a"]) && !isset($_GET["b"]) && isset($_POST['login']) && $_POST['login'] == "ahamu"){
$_SESSION["a"] = $_SESSION["b"] = "";
$_SESSION["a"] = 1;
$_SESSION["b"] = 10;
}
?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
<meta charset="UTF-8" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Product Inquiry - Ahamjad Nigeria Limited</title>
<link rel="shortcut icon" href="../images/favicon.ico">
<link rel="icon" href="../images/favicon.gif" type="image/gif">
<script type="text/javascript" src="../tools/jquery.js"></script>
<script type="text/javascript">
<!--
if (self!=top)
{
top.location.href=self.location.href;
}
//-->
</script>
<style type="text/css">
<!--
body,*{
margin:0px;
padding:0px;
color:#111;
border:0px;
font-weight:normal;
font-size:16px;
font-family: Cambria, helvetica, Georgia, "Times New Roman", Times, serif;
vertical-align:top;
}
div.loginDiv{
text-align:center;
}
div.loginDiv span.error{
color:#f00;
}
form{
width:100%;
overflow:hidden;
}
a{
text-decoration:none;
}
a.logout,input[type="password"],input[type="submit"],input[type="button"],input[type="checkbox"],select,table#fm tr td#searchNav a{
padding:5px;
margin:5px;
border:1px solid #666;
border-radius:5px; 
-moz-border-radius:5px; 
-webkit-border-radius:5px;
-khtml-border-radius:5px;
}
input[type="password"],input[type="checkbox"],select,table#fm tr td#searchNav a{
color:#666;
background:#fff;
}
a.logout{
color:#fff;
font-size:20px;
font-weight:bold;
background:#000;
border:1px solid #000;
float:right;
}
input[type="submit"],input[type="button"]{
font-weight:bold;
color:#fff;
background:#666;
}
table#fm{
width:100%;
border-collapse:collapse;
cursor:default;
}
table#fm td{
color:#666;
padding:5px;
border:1px #666 solid;
}
table#fm td.name_num{
color:#fff;
background:#060;
font-weight:bold;
}
table#fm tr.sel td{
background:#009; 
color:#fff;
}
table#fm tr td#title{
color:#fff;
background:#930;
font-size:18px;
font-weight:bold;
text-align:center;
vertical-align:middle;
}
table#fm tr#head td{
color:#fff;
background:#666;
font-weight:bold;
text-align:left;
vertical-align:middle;
}
table#fm tr td#searchNav{
color:#fff;
background:#666;
overflow:hidden;
vertical-align:middle;
}
table#fm tr td#searchNav a.previousSearch{
float:left;
}
table#fm tr td#searchNav a.nextSearch{
float:right;
}
table#fm tr td#searchNav a:hover{
color:#000;
background:#eee;
}
table#fm tr td.tbCenter{
text-align:center;
}
table#fm tr.even{
background:#ddd;
}
table#fm label{
color:#fff;
font-weight:bold;
}
table#fm tr:hover{
background:#bff;
}
-->
</style>
</head>
<body>

<?php
if (!isset($_SESSION['login']))
  {
?>
<div class="loginDiv">
<?php
if (isset($_POST['login']) && $_POST['login']!="ahamu")
  {
?>
<span class="error">Incorrect password!</span><br />
<?php
}
?>
<form method="post" action="read_messages.php" runat="server" autocomplete="off">
<input type="password" maxlength="9" size="12" value="" id="login" name="login" />
<input type="submit" value="Login" />
</form>
</div>
<script type="text/javascript">
<!--
$(document).ready(function(){
$("#login").focus();
});
//-->
</script>
<?php
}
?>

<?php
function forum($startFromInput,$endAtInput){

$startFrom = $endAt = 0;

?>

<form name="optionForm" id="optionForm" method="post" action="read_messages.php">
<select  name="checkValidity" onChange="javascript:displayOption();">
<option <?php if($_SESSION['checkValidity'] == 0){echo "selected";}?> value="0">Opened Tickets</option>
<option <?php if($_SESSION['checkValidity'] == 1){echo "selected";}?> value="1">Closed Tickets</option>
</select>

<a href="read_messages.php?logout=1" class="logout" target="_top">Logout</a>

</form>

<div id="results">

<?php
$checkValidity = "";
$checkValidity = $_SESSION['checkValidity'];

myConnection();
$result = mysql_query("SELECT * FROM inquiry WHERE Closed = '$checkValidity' ORDER BY id DESC");
$count = mysql_num_rows($result);

$startFrom = test_input($startFromInput);
$startFrom = preg_replace('/\s/', '', $startFrom);
$endAt = test_input($endAtInput);
$endAt = preg_replace('/\s/', '', $endAt);
if($startFrom > $count && $startFrom > 10){
$startFrom = $startFrom - 10;
$endAt = $startFrom + 9;
$_SESSION["a"] = $startFrom;
$_SESSION["b"] = $endAt;
}
if($startFrom > $count && $count == 0){
$startFrom = 0;
$endAt = 0;
}
$startFromPrev = $startFrom - 10;
$startFromNext = $startFrom + 10;
$endAtPrev = $endAt - 10;
if($endAt-$startFrom < 9){
$endAtPrev = $startFromPrev+9;
}
$endAtNext = $endAt + 10;

if($count <= 10){
$endAt = $count;
}
?>

<form name="delForm" id="delForm">
<table id="fm">

<tr>
<td colspan="2" id="title"><?php echo ($_SESSION['checkValidity'] == 1)?"Closed":"Opened"; ?> Tickets on Product Inquiries [Displaying <?php echo $startFrom." &#8211; "; if($endAt > $count){echo $count;}else{echo $endAt;} echo " of ".$count; ?>]</td>
</tr>

<tr><td colspan="2" id="searchNav">
<?php
if($count > 10 && $startFrom > 10){
?>
<a href="read_messages.php?a=<?php echo $startFromPrev; ?>&b=<?php echo $endAtPrev; ?>" class="previousSearch" target="_top">&lt;&lt; Previous</a>
<?php
}
if($count > 10 && $count > $endAtNext){
?>
<a href="read_messages.php?a=<?php echo $startFromNext; ?>&b=<?php echo $endAtNext; ?>" class="nextSearch" target="_top">Next &gt;&gt;</a>
<?php
}
if($count > 10 && $count > $endAt && $count <= $endAtNext){
?>
<a href="read_messages.php?a=<?php echo $startFromNext; ?>&b=<?php echo $count; ?>" class="nextSearch" target="_top">Next &gt;&gt;</a>
<?php
}
?>
</td></tr>

<tr id="head">
<td colspan="2"><input type="checkbox" name="selAll" id="selAll" title="Select all" value=""> <label for="selAll">Select all</label></td>

<?php
if($count > 0)
{
$c = 0;
while($row = mysql_fetch_array($result))
  {
$id = $row['id']; 
$name = $row['FullName']; 
$email = $row['EmailAddress'];
$address = $row['ContactAddress'];
$tel =$row['TelephoneNo'];
$product = $row['Product'];
$add = $row['AdditionalNote'];
$ticket_id = $row['TicketID'];
$date = $row['Date'];
$ans = $row['Closed'];
$c++;
if($c>=$startFrom && $c<=$endAt){
?>
<tr><td colspan="2" class="name_num"><input name="checkbox" type="checkbox"  id="<?php echo $id; ?>"value="<?php echo $id; ?>"> <label for="<?php echo $id; ?>"><?php echo "#{$c} {$name}"; ?></label></td></tr>
<tr class="tr<?php echo $id; ?> all"><td style="width:90px;" >Ticket ID</td><td><?php echo $ticket_id; ?></td></tr>
<tr class="even tr<?php echo $id; ?> all"><td>Date</td><td><?php echo $date; ?></td></tr>
<tr class="tr<?php echo $id; ?> all"><td>Email</td><td><?php echo $email; ?></td></tr>
<tr class="even tr<?php echo $id; ?> all"><td>Address</td><td><?php echo $address; ?></td></tr>
<tr class="tr<?php echo $id; ?> all"><td>Telephone</td><td><?php echo $tel; ?></td></tr>
<tr class="even tr<?php echo $id; ?> all"><td>Product</td><td><?php echo $product; ?></td></tr>
<tr class="tr<?php echo $id; ?> all"><td>Details</td><td><?php echo $add; ?></td></tr>
<tr class="even tr<?php echo $id; ?> all"><td>Status</td><td><input type="button" value="<?php echo ($_SESSION["checkValidity"] == 1)?"Closed":"Close ticket"; ?>"<?php echo ($_SESSION["checkValidity"] == 1)?" disabled":""; ?> id="<?php echo $id; ?>" onClick="Javascript:validityCheck(this.id);" /></td></tr>
<?php
}
}
}else{
?>
<tr><td colspan="2" class="tbCenter">No Inquiries</td></tr>
<?php
}
?>

<tr><td colspan="2" class="tbCenter"><input name="delete" type="button" id="delete" value="Delete Selected Inquiries"></td></tr>

</table>
</form>
</div>
<?php
}
?>

<?php
if(isset($_SESSION["a"]) && isset($_SESSION["b"])){
forum($_SESSION["a"],$_SESSION["b"]);
?>
<script type="text/javascript">
<!--
$("#delForm input:checkbox:not(#selAll)").change(function () {
$("tr.tr"+$(this).val()).toggleClass("sel");
var  detUnchecked = $("#delForm input:checkbox:not(#selAll):not(:checked)").length;
if(detUnchecked > 0){
$("#delForm input#selAll").prop("checked",false);
}else{
$("#delForm input#selAll").prop("checked",true);
}
});

$("#selAll").change(function () {
$("#delForm input:checkbox:not(#selAll)").prop("checked", $(this).prop("checked"));
var propSelAll = $(this).prop("checked");
if(propSelAll == true){
$("#delForm tr.all").addClass("sel");
}else{
$("#delForm tr.all").removeClass("sel");
}
});

$("#delete").click(function () {
var delChecked = "";
$.each($("#delForm input:checkbox:not(#selAll):checked"), function() {
delChecked = delChecked +  $(this).val() + ",";
});
$.post("read_messages2.php", {checkbox:delChecked},function(data){$("#results").html(data);});
});
//-->
</script>
<?php
}
?>

<?php 
if(isset($_SESSION['login']))
{
?>
<script type="text/javascript">
<!--

function displayOption(){
$("form#optionForm").submit();
}

function validityCheck(vine){
var vData = "read_messages3.php?valid="+vine;
$.post(vData, function(data){$("#results").html(data);});
}

//-->
</script>
<?php 
}
?>
</body>
</html>