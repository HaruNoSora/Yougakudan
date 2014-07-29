<?php 

include("oauth.php"); 

$page_title = "Tweet Bomb"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json1 = $object->request("GET","users/show",$param); 
 if(empty($json1->errors)) 
 { 
  if(isset($_GET["count"]) && preg_match("/^[0-9]{1,3}$/",$_GET["count"]) && $_GET["count"] <= 100) 
  { 
   $name = $json1->name; 
   $screen_name = $json1->screen_name; 
   $i = 0; 
   $count = $_GET["count"]; 
   while($i < $count) 
   { 
    $mt_rand = microtime(); 
    $params[$i]["status"] = " @" . $screen_name . " " . $mt_rand; 
    $i++; 
   } 
   $json2 = $object->multi_request("POST","statuses/update",$params); 
   if(empty($json2->errors)) 
   { 

?> 
<?= $name . "(". $screen_name . ")" ?>宛てに<?= $i ?>個のツイートを送信しました。<br> 
<?php 

   } 
  } 
  else 
  { 

?> 
回数の指定がおかしいです<br> 
<?php 

  } 
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
<input type="text" name="username" class="input_text" placeholder="Nom de l'utilisateur" value=""> 
<select name="count" class="select"> 
<option value="">▼ Nombre de tweet</option> 
<option value="10">10 tweets</option> 
<option value="50">50 tweets</option> 
<option value="100">100 tweets</option> 
</select> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

} 

include("foot.php"); 

?>