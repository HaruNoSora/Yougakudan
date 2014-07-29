<?php 

include("oauth.php"); 

$page_title = "アカウントけんさく"; 
include("head.php"); 

if(isset($_GET["query"])) 
{ 
 $object = new oauth(); 
 $param["count"] = 100; 
 $param["q"] = $_GET["query"]; 
 $json = $object->request("GET","users/search",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json as $list) 
  { 
   $name = $list->name; 
   $screen_name = $list->screen_name; 
   $profile_img = str_replace("_normal.",".",$list->profile_image_url_https); 
   $description = $list->description; 

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
<input type="text" name="query" class="input_text" placeholder="キーワード" value=""> 
<input type="submit" class="input_submit" value="そうしん"><br> 
</form> 
<?php 

} 

include("foot.php"); 

?>