<?php 

include("oauth.php"); 

$page_title = "トレンドタイムライン"; 
include("head.php"); 

$object = new oauth(); 
$json = $object->request("GET","trends/timeline"); 
if(empty($json->errors)) 
{ 
 foreach($json->data as $list) 
 { 
  if($list->metadata->type == "TRENDS") 
  { 
   $trend_name = $list->name; 
   $trend_query = $list->query; 

?> 
<a href="search_tweets?query=<?= $trend_query ?>" class="button"><?= $trend_name ?></a> 
<table class="list"> 
<?php 

   foreach($list->tweets as $list) 
   { 
    $name = $list->user->name; 
    $screen_name = $list->user->screen_name; 
    $profile_img = str_replace("_normal.",".",$list->user->profile_image_url_https); 
    $text = str_replace("\n","<br>\n",$list->text); 
    $id_str = $list->id_str; 
    $created_at = date("Y/m/d-H:i:s",strtotime($list->created_at)); 
    $source = strip_tags($list->source); 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_img ?>" class="icon"> 
</a> 
</td> 
<td class="wide"> 
<a href="statuses_show?id=<?= $id_str ?>"> 
<span class="bold"><?= $name ?></span>　<span class="small"><?= $screen_name ?></span><br> 
<?= $text ?><br> 
<span class="small"><?= $created_at ?>　<?= $source ?></span><br> 
</a> 
</td> 
</tr> 
<?php 

   } 

?> 
</table> 
<br> 
<?php 

  } 
 } 
} 
else 
{ 

?> 
エラーが はっせい しました<br> 
<?php 

} 

include("foot.php"); 

?>