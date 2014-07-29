<?php 

include("oauth.php"); 

$page_title = "ツイート消すやつ"; 
include("head.php"); 

if(isset($_POST["mode"]) && $_POST["mode"] === "run") 
{ 
 $object = new oauth(); 
 $param["count"] = 100; 
 $json = $object->request("GET","statuses/user_timeline",$param); 
 if(empty($json->errors)) 
 { 
  $i = 0; 
  foreach($json as $list) 
  { 
   $apis[] = "statuses/destroy/" . $list->id_str; 
   $i++; 
  } 
  $json = $object->multi_request("POST",$apis); 
  if(empty($json->errors)) 
  { 

?> 
<?= $i ?>この ツイートを さくじょしました<br> 
<?php 

  } 
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
<form action="" method="post"> 
<input type="hidden" name="mode" value="run"> 
<input type="submit" class="input_submit" value="じっこう"> 
</form> 
<?php 

} 

include("foot.php"); 

?>