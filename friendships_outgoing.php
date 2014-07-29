<?php 

include("oauth.php"); 

$page_title = "フォロー申請中リスト"; 
include("head.php"); 

$i = 0; 
$object = new oauth(); 
$param1["cursor"] = !empty($_GET["cursor"]) ? $_GET["cursor"] : -1 ; 
$param1["count"] = 100; 
$json1 = $object->request("GET","friendships/outgoing",$param1); 
if(empty($json1->errors) && count($json1->ids)) 
{ 
 foreach($json1->ids as $list) 
 { 
  $ids[$i] = $list; 
  $i++; 
 } 
 $next_cursor = $json1->next_cursor_str; 
 $prev_cursor = $json1->previous_cursor_str; 
 $param2["user_id"] = implode(",",array_slice($ids,0)); 
 $json2 = $object->request("GET","users/lookup",$param2); 
 if(empty($json2->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json2 as $list) 
  { 
   $name = $list->name; 
   $screen_name = $list->screen_name; 
   $profile_image_url = str_replace("_normal.",".",$list->profile_image_url_https); 
   $description = $list->description; 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_image_url ?>" class="icon"> 
</a> 
</td> 
<td class="wide"> 
<a href="users_show?username=<?= $screen_name ?>"> 
<span class="bold"><?= $name ?></span>　<span class="small"><?= $screen_name ?></span><br> 
<?= $description ?><br> 
</a> 
</td> 
</tr> 
<?php 

  } 

?> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="?cursor=<?= $prev_cursor ?>" class="block">前のページ</a> 
</td> 
<td> 
<a href="?cursor=<?= $next_cursor ?>" class="block">次のページ</a> 
</td> 
</tr> 
</table> 
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

?> 
エラーが発生しました<br> 
<?php 

} 

include("foot.php"); 

?>