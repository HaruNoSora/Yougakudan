<?php 

include("oauth.php"); 

$page_title = "スパムほうこく"; 
include("head.php"); 

if(isset($_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"];  
 $json = $object->request("POST","users/report_spam",$param); 
 if(empty($json->errors)) 
 { 

?> 
<?= $json->name . "(" . $json->screen_name . ")" ?>を スパムほうこくしました<br> 
<?php 

 } 
 else 
 { 

?> 
エラーが はっせいしました<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<input type="submit" class="input_submit" value="そうしん"> 
</form> 
<?php 

} 

include("foot.php"); 

?>