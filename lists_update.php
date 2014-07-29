<?php 

include("oauth.php"); 

$page_title = "リストの編集"; 
include("head.php"); 

if(isset($_GET["list_id"],$_GET["name"],$_GET["description"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $param["name"] = $_GET["name"]; 
 $param["description"] = $_GET["description"]; 
 $json = $object->request("POST","lists/update",$param); 
 if(empty($json->errors)) 
 { 

?> 
リストを編集しました<br> 
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
<input type="text" name="name" class="input_text" placeholder="名前" value=""> 
<input type="text" name="description" class="input_text" placeholder="説明文" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>