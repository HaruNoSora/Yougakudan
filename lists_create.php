<?php 

include("oauth.php"); 

$page_title = "リストの作成"; 
include("head.php"); 

if(isset($_GET["name"]) && !empty($_GET["description"])) 
{ 
 $object = new oauth(); 
 $param["name"] = $_GET["name"]; 
 $param["description"] = $_GET["description"]; 
 $json = $object->request("POST","lists/create",$param); 
 if(empty($json->errors)) 
 { 

?> 
リストを作成しました<br> 
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
<input type="text" name="name" class="input_text" placeholder="名前" value=""> 
<input type="text" name="description" class="input_text" placeholder="説明文" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>