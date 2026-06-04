
<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start();
include "../includes/my_connection.php";

function forum($startFromInput,$endAtInput){
$checkValidity = $startFrom = $endAt = "";
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
<tr class="tr<?php echo $id; ?> all"><td style="width:110px;" >Ticket ID</td><td><?php echo $ticket_id; ?></td></tr>
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
<?php
}
?>


<?php
if (isset($_REQUEST['valid']))
  {
$validityStatus = "";

myConnection();

if($_SESSION['checkValidity'] == 1){
$validityStatus = 0;
}else{
$validityStatus = 1;
}

mysql_query("UPDATE inquiry SET Closed = '$validityStatus' WHERE id = '$_REQUEST[valid]'");

}

if (isset($_REQUEST['valid']))
{
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