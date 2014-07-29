<?php 

include("oauth.php"); 

$page_title = "メッセージの削除"; 
include("head.php"); 

if(isset($_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $object = new oauth(); 
 $param["id"] = $_GET["id"]; 
 $json = $object->request("POST","direct_messages/destroy",$param); 
 if(empty($json->errors)) 
 { 

?> 
メッセージを削除しました<br> 
<br> 
<?= $json->recipient->name . "(@" . $json->recipient->screen_name . ")" ?><br> 
<?= $json->text ?><br> 
<?php 

 } 
 else 
 { 

?> 
エラーが発生しました<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="id" class="input_text" placeholder="メッセージＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>