<?php 

include("oauth.php"); 

$page_title = "にているアカウント"; 
include("head.php"); 

if(isset($_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("GET","users/recommendations",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json as $list) 
  { 
   $name = $list->user->name; 
   $screen_name = $list->user->screen_name; 
   $profile_img = str_replace("_normal.",".",$list->user->profile_image_url_https); 
   $description = $list->user->description; 

?> 
<tr> 
<td> 
<a href="users_show?username=<?= $screen_name ?>"> 
<img src="<?= $profile_img ?>" class="icon"> 
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
<input type="submit" class="input_submit" value="そうしん"><br> 
</form> 
<?php 

} 

include("foot.php"); 

?>