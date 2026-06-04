<?php

function directory() {
echo "http://localhost/ahamjad/";
}
$directory = "http://localhost/ahamjad/";
$directory2 = str_replace("http://","",$directory);

function myConnection(){
$con = mysql_connect("localhost","root","P@ssw0rd");
if (!$con)
  {
  die('Could not connect.');
  }
mysql_select_db("ahamjad", $con);
}

function test_input($data) {
$data = trim($data);
$data = preg_replace('/\s+/', ' ', $data);
$data = htmlentities($data, ENT_QUOTES);
$data = mysql_real_escape_string($data);
return $data;
}

function redirect($filename){
if(!headers_sent()){
header('Location: '.$filename);
}else{
?>
<script type="text/javascript">
<!--
window.location.href="<?php echo $filename; ?>";
//-->
</script>
<noscript>
<meta http-equiv="refresh" content="0;url=<?php echo $filename; ?>" />
</noscript>
<?php
}
}

function splitValue($value){
$valueName = "";
$valueName = $value;
$valueNameLen = strlen($valueName);
$HyphenPos = strrpos($valueName,"-");
if($HyphenPos > 0){
$valueName = substr($valueName,0,$HyphenPos-1);
}
return $valueName;
}
function splitCode($value){
$valueName = $valueCode = "";
$valueName = $value;
$valueNameLen = strlen($valueName);
$HyphenPos = strrpos($valueName,"-");
if($HyphenPos > 0){
$valueCode = substr($valueName,$HyphenPos+2,$valueNameLen-$HyphenPos-2);
}
return $valueCode;
}

function testTotal($amount){
$amountReturn = preg_replace('#[^0-9.]#i', '', $amount);
$amountReturn = test_input($amountReturn);
$amountReturn = str_replace(",","",$amountReturn);
$amountReturn = str_replace("-","",$amountReturn);
$amountPos = strpos($amountReturn,".");
if($amountPos > 0){
$amountReturn = substr($amountReturn,0,$amountPos+3);
}
return $amountReturn;
}

function testQty($amount){
$amountReturn = preg_replace('#[^0-9]#i', '', $amount);
$amountReturn = test_input($amountReturn);
$amountReturn = str_replace(",","",$amountReturn);
$amountReturn = str_replace("-","",$amountReturn);
$amountPos = strpos($amountReturn,".");
if($amountPos > 0){
$amountReturn = substr($amountReturn,0,$amountPos);
}
return $amountReturn;
}

function clean_text($text){
$textReturn = preg_replace('#[^a-z ]#i', '', $text);
$textReturn = test_input($textReturn);
return $textReturn;
}

function formatNumber($amount){
$amountOriginal = "{$amount}";
if($amountOriginal != ""){
$sign_left = ($amountOriginal < 0)?"(":"";
$sign_right = ($amountOriginal < 0)?")":"";
$amountOriginal = $sign_left . number_format(abs($amountOriginal), 2, '.', ',') . $sign_right;
}
return $amountOriginal;
}

function formatQty($amount){
$amountOriginal = "{$amount}";
if($amountOriginal != ""){
$amountOriginal = number_format($amountOriginal, 0, '', ',');
}
return $amountOriginal;
}
?>