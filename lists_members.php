<?php 

include("oauth.php"); 

$page_title = "メンバー"; 
include("head.php"); 

if(isset($_GET["list_id"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $param["cursor"] = !empty($_GET["cursor"]) ? $_GET["cursor"] : -1; 
 $json = $object->request("GET","lists/members",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json->users as $list) 
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
  $next_cursor = $json->next_cursor_str; 
  $prev_cursor = $json->previous_cursor_str; 

?> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="?list_id=<?= $param["list_id"] ?>&cursor=<?= $prev_cursor ?>" class="block">前のページ</a> 
</td> 
<td> 
<a href="?list_id=<?= $param["list_id"] ?>&cursor=<?= $next_cursor ?>" class="block">次のページ</a> 
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
<form action="" method="get"> 
<input type="text" name="list_id" class="input_text" placeholder="リストＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>