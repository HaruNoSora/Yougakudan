<?php 

include("oauth.php"); 

$page_title = "おすすめアカウント"; 
include("head.php"); 

if(isset($_GET["slug"])) 
{ 
 $object = new oauth();  
 $slug = urlencode($_GET["slug"]); 
 $json = $object->request("GET","users/suggestions/" . $slug); 
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
 $object = new oauth() 
 $json = $object->request("GET","users/suggestions"); 
 if(empty($json->errors)) 
 { 

?> 
<form action="" method="get"> 
<select name="slug" class="select"> 
<option value="">▼カテゴリーをせんたく</option> 
<?php 

  foreach($json as $list) 
  { 
   $name = $list->name; 
   $slug = $list->slug; 
   $size = $list->size; 

?> 
<option value="<?= $slug ?>"><?= $name . "(" . $size . "人)" ?></option> 
<?php 

  } 

?> 
</select> 
<input type="submit" class="input_submit" value="そうしん"> 
</form> 
<?php 

 } 
 else 
 { 

?> 
エラーが はっせいしました<br> 
<?php 

 } 
} 

include("foot.php"); 

?>