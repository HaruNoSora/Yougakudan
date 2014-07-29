<?php 

include("oauth.php"); 

$page_title = "Activités"; 
include("head.php"); 

$object = new oauth(); 
$param["count"] = 100; 
$json = $object->request("GET","activity/about_me",$param); 
if(empty($json->errors)) 
{ 

?> 
<table class="list"> 
<?php 

 foreach($json as $list) 
 { 
  switch($list->action) 
  { 
   case "reply": 
    $string = "Réponse est venue de"; 
    $text = $list->targets[0]->text; 
    break; 
   case "mention": 
    $string = "On venait de"; 
    $text = $list->target_objects[0]->text; 
    break; 
   case "retweet": 
    $string = "J'ai été retweeté à"; 
    $text = $list->target_objects[0]->text; 
    break; 
   case "favorite": 
    $string = "Il a été enregistré aux Favoris"; 
    $text = $list->targets[0]->text; 
    break; 
   case "follow": 
    $string = "Mais je dois suivre"; 
    $text = ""; 
    break; 
  } 
  $name = $list->sources[0]->name; 
  $screen_name = $list->sources[0]->screen_name; 
  $sources = $list->sources_size - 1; 
  if($sources > 0) 
  { 
   $string = "(Autre". $sources ."Personnes)". $string; 
  } 
  $profile_image_url = str_replace("_normal.",".",$list->sources[0]->profile_image_url_https); 
  $created_at = date("Y年m月d日H時i分s秒",strtotime($list->created_at)); 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_image_url ?>" class="icon"> 
</a> 
</td> 
<td class="wide"> 
<p> 
<span class="bold"><?= $name ?></span>　<span class="small"><?= $string ?></span><br> 
<?php 

  if(isset($text)) 
  { 

?> 
<?= $text ?><br> 
<?php 

  } 

?> 
<span class="small"><?= $created_at ?></span><br> 
</p> 
</td> 
</tr> 
<?php 

 } 

?> 
</table> 
<?php 

} 
else 
{ 

?> 
Une erreur est survenue.<br> 
<?php 

} 

include("foot.php"); 

?>