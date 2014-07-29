<?php 

include("oauth.php"); 

$page_title = "リストの削除"; 
include("head.php"); 

if(isset($_GET["list_id"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $json = $object->request("POST","lists/destroy",$param); 
 if(empty($json->errors)) 
 { 

?> 
リストを削除しました<br> 
<br> 
<?= $json->name . "：" . $json->description ?><br> 
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
<input type="text" name="list_id" class="input_text" placeholder="リストＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>