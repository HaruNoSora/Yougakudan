<?php 

include("oauth.php"); 

$page_title = "Block"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("POST","blocks/create",$param); 
 if(empty($json->errors)) 
 { 

?> 
A bloqué.<br> 
<br> 
<?= $json->name . "(@" . $json->screen_name . ")" ?><br> 
<?php 

 } 
 else 
 { 

?> 
Une erreur est survenue.<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="username" class="input_text" placeholder="Nom d'utilisateur" value=""> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

} 

include("foot.php"); 

?>