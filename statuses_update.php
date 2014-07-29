<?php 

include("oauth.php"); 

$page_title = "ツイートの送信"; 
include("head.php"); 

if(isset($_GET["status"])) 
{ 
 $object = new oauth(); 
 $param["status"] = $_GET["status"]; 
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

?> 
<form action="" method="get"> 
<textarea name="status" class="textarea" placeholder="テキスト"><?= $string ?></textarea> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>