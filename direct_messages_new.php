<?php 

include("oauth.php"); 

$page_title = "メッセージの送信"; 
include("head.php"); 

if(isset($_GET["username"],$_GET["text"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $param["text"] = $_GET["text"]; 
 $json = $object->request("POST","direct_messages/new",$param); 
 if(empty($json->errors)) 
 { 

?> 
メッセージを送信しました<br> 
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
 $username = !empty($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"]) ? $_GET["username"] : NULL; 

?> 
<form action="" method="get"> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value="<?= $username ?>"> 
<textarea name="text" class="textarea" placeholder="テキスト"></textarea> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>