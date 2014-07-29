<?php 

include("oauth.php"); 

$page_title = "フレンドチェック"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("GET","users/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->name; 
  $screen_name = $json->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->profile_image_url_https); 
  $follows = $followers = array(); 
  $param["cursor"] = -1; 
  while($param["cursor"] != 0) 
  { 
   $json = $object->request("GET","friends/ids",$param); 
   foreach($json->ids as $list) 
   { 
    $follows[] = $list; 
   } 
   $param["cursor"] = $json->next_cursor_str; 
  } 
  $param["cursor"] = -1; 
  while($param["cursor"] != 0) 
  { 
   $json = $object->request("GET","followers/ids",$param); 
   foreach($json->ids as $list) 
   { 
    $followers[] = $list; 
   } 
   $param["cursor"] = $json->next_cursor_str; 
  } 
  $follows_count = $followers_count = 0; 
  for($i = 0;$i < count($follows);$i++) 
  { 
   if(!in_array($follows[$i],$followers)) 
   { 
    $follows_count++; 
   } 
  } 
  for($i = 0;$i < count($followers);$i++) 
  { 
   if(!in_array($followers[$i],$follows)) 
   { 
    $followers_count++; 
   } 
  } 
  $friends_count = count($followers) - $follows_count - $followers_count; 
  $follows_per = round($follows_count / count($follows) * 100,3); 
  $followers_per = round($followers_count / count($followers) * 100,3); 
  $friends_per = round($friends_count / count($followers) * 100,3); 

?> 
<table class="centering"> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>" class="block"> 
<img src="<?= $profile_img ?>" class="icon"><br> 
<span class="big bold"><?= $name ?></span>　<?= $screen_name ?><br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
フォロー数<br> 
</td> 
<td> 
<?= count($follows) ?>人<br> 
</td> 
</tr> 
<tr> 
<td> 
フォロワー数<br> 
</td> 
<td> 
<?= count($followers) ?>人<br> 
</td> 
</tr> 
<tr> 
<td> 
Ｆ／Ｆ比率<br> 
</td> 
<td> 
<?= round(count($follows) / count($followers) * 100,3) ?>％<br> 
</td> 
</tr> 
<tr> 
<td> 
片思い<br> 
</td> 
<td> 
<?= $follows_count ?>人（<?= $follows_per ?>％）<br> 
</td> 
</tr> 
<tr> 
<td> 
片思われ<br> 
</td> 
<td> 
<?= $followers_count ?>人（<?= $followers_per ?>％）<br> 
</td> 
</tr> 
<tr> 
<td> 
両思い<br> 
</td> 
<td> 
<?= $friends_count ?>人（<?= $friends_per ?>％）<br> 
</td> 
</tr> 
</table> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<input type="submit" class="input_submit" value="実行"> 
</form> 
<?php 

} 

include("foot.php"); 

?>