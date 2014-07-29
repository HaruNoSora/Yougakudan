<?php 

include("oauth.php"); 

$page_title = "ツイートの送信"; 
include("head.php"); 

if(isset($_GET["status"],$_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $object = new oauth(); 
 $param["status"] = $_GET["status"]; 
 $param["in_reply_to_status_id"] = $_GET["id"]; 
 $json = $object->request("POST","statuses/update",$param); 
 if(empty($json->errors)) 
 { 

?> 
ツイートを送信しました<br> 
<br> 
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
 $string = isset($_GET["string"]) ? htmlspecialchars($_GET["string"]) : NULL; 
 $id = isset($_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"]) ? $_GET["id"] : NULL; 

?> 
<form action="" method="get"> 
<input type="text" name="id" class="input_text" placeholder="ツイートＩＤ" value="<?= $id ?>"> 
<textarea name="status" class="textarea" placeholder="テキスト"><?= $string ?></textarea> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>