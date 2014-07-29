<?php 

include("oauth.php"); 

$page_title = "リストの解約"; 
include("head.php"); 

if(isset($_GET["list_id"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $json = $object->request("POST","lists/subscribers/destroy",$param); 
 if(empty($json->errors)) 
 { 

?> 
「<?= $json->name ?>」を解約しました<br> 
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
<input type="text" name="list_id" class="input_text" placeholder="リストＩＤ" value="<?= $list_id ?>"> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?> 