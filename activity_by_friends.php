<?php 

include("oauth.php"); 

$page_title = "友達のアクティビティー"; 
include("head.php"); 

$object = new oauth(); 
$param["count"] = 100; 
$json = $object->request("GET","activity/by_friends",$param); 
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
    $string = "からリプライが来ました"; 
    $text = $list->targets[0]->text; 
    break; 
   case "mention": 
    $string = "からメンションが来ました"; 
    $text = $list->target_objects[0]->text; 
    break; 
   case "retweet": 
    $string = "にリツイートされました"; 
    $text = $list->target_objects[0]->text; 
    break; 
   case "favorite": 
    $string = "にお気に入り登録されました"; 
    $text = $list->targets[0]->text; 
    break; 
   case "follow": 
    $string = "がフォローしました"; 
    $text = ""; 
    break; 
  } 
  $name = $list->sources[0]->name; 
  $screen_name = $list->sources[0]->screen_name; 
  $sources = $list->sources_size - 1; 
  if($sources > 0) 
  { 
   $string = "(他". $sources ."人)". $string; 
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
エラーが発生しました<br> 
<?php 

} 

include("foot.php"); 

?>