<?php include "../includes/header.php"; ?>

<style>
<!--
div.success{
background:#099;
color:#fff;
overflow:hidden;
text-align:center;
width:100%;
padding-top:10px;
padding-bottom:10px;
}
div.content{
margin:10px;
background:#ddd;
border-radius:5px; 
-moz-border-radius:5px; 
-webkit-border-radius:5px;
}
div.content form{
margin:10px;
padding-top:10px;
padding-bottom:10px;
}
div.content ul{
list-style-type:none;
width:
}
div.content ul li{
display:block;
clear:both;
margin-top:5px;
}
div.content li.error input[type='text'], div.content li.error textarea, div.content li.error select{
border:1px solid #f00;
color:#300;
}
li.error div{
color:#f00;
font-size:16px;
}
.labelList{
margin-top:10px;
font-size:18px;
}
input[type='text'], textarea, select
{
border:1px solid #666;
border-radius:5px; 
-moz-border-radius:5px; 
-webkit-border-radius:5px;
text-indent:15px;
padding-top:10px;
padding-bottom:10px;
color:#333;
width:100%;
background:#fff;
}
input[type='submit']{
background:#090;
color:#fff;
font-weight:bold; 
font-size:18px;
border-radius:10px; 
-moz-border-radius:10px; 
-webkit-border-radius:10px;
padding:10px;
text-align:center;
}
-->
</style>

<?php 
if(isset($_POST["submit"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["address"]) && !empty($_POST["phone"]) && preg_match("/^[0-9+]*$/",$_POST["phone"]) && !empty($_POST["product"]) && !empty($_POST["note"])){
$name = $address = $phone = $product = $note = $date = $to = $subject = $message = $headers = "";

myConnection();

$name = test_input($_POST["name"]);
$email = strtolower(test_input($_POST["email"]));
$address = test_input($_POST["address"]);
$phone = test_input($_POST["phone"]);
$product = test_input($_POST["product"]);
$note= test_input($_POST["note"]);
$date = date("Y-m-d H:i:s");

$sqlEdit = mysql_query("SELECT * FROM inquiry ORDER BY id DESC LIMIT 1");
$edit = mysql_fetch_array($sqlEdit);	
$ticketID = "TIC". str_pad($edit["id"]+1,6,"0",STR_PAD_LEFT);

$_SESSION["success"] = "<div class='success'>Inquiry successfully sent. We will get back to you shortly.</div>";

$sql = "INSERT INTO inquiry (FullName,EmailAddress,ContactAddress,TelephoneNo,Product,AdditionalNote,TicketID,Date) VALUES ('$name','$email','$address','$phone','$product','$note','$ticketID','$date')";

$to = "{$email}, ahamjadnigltd@yahoo.com";

$subject = "[Ticket ID: {$ticketID}] Ahamjad Nigeria Limited - {$name}";

$message =  "
<img src=\"{$directory}images/logo.gif\" /><br /><br />
<div style='font-size:16px;font-family:helvetica;color:#000;'>Inquiry on <b>{$product}</b>,<br /><br />
<b>Address:</b> {$address}<br /><br />
<b>Phone:</b> {$phone}<br /><br />
<b>Additional Note:</b> {$note}<br /><br />
Dear {$name},<br />
Thank you for making an inquiry one of our products through our web portal. We will get back to you soon.
<p>&nbsp;</p>
<p>&nbsp;</p>
Visit main site: <a href=\"{$directory2}\">Ahamjad Nigeria Limited</a><br />
S/L/L/G, Shop 301, Ifesowapo Iron Market, Section \"C\", Line 1, Orile Iganmu, Lagos.<br />
<b>Phone:<b/> +2348099736396<br />
<b>Email:<b/> ahamjadnigltd@yahoo.com, info@ahamjad.com
</div>";
$message = wordwrap($message,70);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Ahamjad Nigeria Limited <info@ahamjad.com>" . "\r\n";

mail($to,$subject,$message,$headers);

if(!mysql_query($sql))
{exit("Error.");}
else{
redirect("{$directory}privates/Inquiry.php");
}
}
?>

<div class="rightContent">
<?php if(isset($_SESSION["success"]) && !isset($_POST["submit"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
} ?>
<div class="content_header">Inquiry</div>

<div class="content">
<form method="post" enctype="multipart/form-data" name="inquiry" id="inquiry" action="privates/Inquiry.php" runat="server" autocomplete="off">
<ul>
<li  class="labelList"><label for="name">Full Name:</label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["name"]) == "0" || trim($_POST["name"]) == "")){ echo " class='error'";} ?>><input type="text" name="name" id="name" value="<?php if(isset($_POST["name"])){ echo trim($_POST["name"]); } ?>" placeholder="Your Full Name" required />
<?php if(isset($_POST["submit"]) && (trim($_POST["name"]) == "0" || trim($_POST["name"]) == "")){ echo "<div>Name is required.</div>";} ?>
</li>
<li  class="labelList"><label for="email">Email:</label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["email"]) == "0" || trim($_POST["email"]) == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){ echo " class='error'";} ?>><input type="text" name="email" id="email" value="<?php if(isset($_POST["email"])){ echo trim($_POST["email"]); } ?>" placeholder="Your Contact Email" onKeyUp="javascript:this.value=this.value.toLowerCase();" required />
<?php if(isset($_POST["submit"]) && (trim($_POST["email"]) == "0" || trim($_POST["email"]) == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){ echo "<div>Valid email is required.</div>";} ?>
</li>
<li  class="labelList"><label for="address">Address:<br>
<i>(including state and country)</i></label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["address"]) == "0" || trim($_POST["address"]) == "")){ echo " class='error'";} ?>><textarea cols="16" rows="1" name="address" id="address" placeholder="Your Contact Address" required ><?php if(isset($_POST["address"])){ echo trim($_POST["address"]); } ?></textarea>
<?php if(isset($_POST["submit"]) && (trim($_POST["address"]) == "0" || trim($_POST["address"]) == "")){ echo "<div>Address is required.</div>";} ?>
</li>
<li  class="labelList"><label for="phone">Telephone No.:<br />
<i>(For outside Nigeria, add country code)</i>
</label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["phone"]) == "0" || trim($_POST["phone"]) == "" || !preg_match("/^[0-9+]*$/",$_POST["phone"]))){ echo " class='error'";} ?>><input type="text" onKeyPress="return IsNumeric3(event);" ondrop="return false;" onpaste="return false;" name="phone" id="phone" value="<?php if(isset($_POST["phone"])){ echo trim($_POST["phone"]); } ?>" placeholder="Your Contact Number" required />
<?php if(isset($_POST["submit"]) && (trim($_POST["phone"]) == "0" || trim($_POST["phone"]) == "" || !preg_match("/^[0-9+]*$/",$_POST["phone"]))){ echo "<div>Phone no. is required.</div>";} ?>
</li>
<li  class="labelList"><label for="phone">Product:</label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["product"]) == "0" || trim($_POST["product"]) == "")){ echo " class='error'";} ?>>
<select name="product" required >
<option value=""<?php if(isset($_POST["submit"]) &&  (trim($_POST["product"]) == "" ||  trim($_POST["product"]) == "0") || !isset($_POST["submit"])){ echo " selected='selected'";} ?>>[Select your desired product]</option>
<option value="Plate"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Plate"){ echo " selected='selected'";} ?>>Plate</option>
<option value="H. Beam"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "H. Beam"){ echo " selected='selected'";} ?>>H. Beam</option>
<option value="Angle"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Angle"){ echo " selected='selected'";} ?>>Angle</option>
<option value="Hollow Pipe"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Hollow Pipe"){ echo " selected='selected'";} ?>>Hollow Pipe</option>
<option value="Flat Bar"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Flat Bar"){ echo " selected='selected'";} ?>>Flat Bar</option>
<option value="UPN Channel"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "UPN Channel"){ echo " selected='selected'";} ?>>UPN Channel</option>
<option value="Z-Poline"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Z-Poline"){ echo " selected='selected'";} ?>>Z-poline</option>
<option value="Gratting Wire"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Gratting Wire"){ echo " selected='selected'";} ?>>Gratting Wire</option>
<option value="Others"<?php if(isset($_POST["submit"]) && trim($_POST["product"]) == "Others"){ echo " selected='selected'";} ?>>Others</option>
</select>
<?php if(isset($_POST["submit"]) && (trim($_POST["product"]) == "0" ||  trim($_POST["product"]) == "")){ echo "<div>Desired product is required.</div>";} ?>
</li>
<li  class="labelList"><label for="note">Additional Note:</label></li>
<li<?php if(isset($_POST["submit"]) && (trim($_POST["note"]) == "0" || trim($_POST["note"]) == "")){ echo " class='error'";} ?>><textarea cols="16" rows="3" name="note" id="note" placeholder="Additional Info. About Inquiry" required ><?php if(isset($_POST["note"])){ echo trim($_POST["note"]); } ?></textarea>
<?php if(isset($_POST["submit"]) && (trim($_POST["note"]) == "0" || trim($_POST["note"]) == "")){ echo "<div>Additional note is required.</div>";} ?>
</li>
<li style="text-align:right;"><input type="submit" name="submit" value="Submit" class="button" /></li>
</ul>
 </form>
 </div>

</div>

<script>
<!--
var specialKeys = new Array();
specialKeys.push(8); 
specialKeys.push(43); 
specialKeys.push(37); 
specialKeys.push(39); 
//Backspace
function IsNumeric3(e) {
var keyCode = e.which ? e.which : e.keyCode
var ret = (keyCode != 37 && keyCode != 8 && keyCode != 46 && (keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
return ret;
}
//-->
</script>

<?php include "../includes/footer.php"; ?>