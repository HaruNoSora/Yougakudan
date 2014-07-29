<?php 

include("oauth.php"); 

$page_title = "メンバーの除外"; 
include("head.php"); 

if(isset($_GET["list_id"],$_GET["screen_name"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("POST","lists/members/destroy",$param); 
 if(empty($json->errors)) 
 { 

?> 
「<?= $json->name ?>」から<?= $json->user->name . "(" . $json->user->screen_name . ")" ?>を除外しました<br> 
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
 $list_id = !empty($_GET["list_id"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"]) ? $_GET["list_id"] : NULL ; 

?> 
<form action="" method="get"> 
<input type="text" name="list_id" class="input_text" placeholder="リストＩＤ" value="<?= $list_id ?>"> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?> 