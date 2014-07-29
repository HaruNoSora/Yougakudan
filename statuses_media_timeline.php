<?php 

include("oauth.php"); 

$page_title = "メディアタイムライン"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $param["count"] = 100; 
 $json = $object->request("GET","statuses/media_timeline",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json as $list) 
  { 
   $name = $list->user->name; 
   $screen_name = $list->user->screen_name; 
   $profile_image_url = str_replace("_normal.",".",$list->user->profile_image_url_https); 
   $text = str_replace("\n","<br>\n",$list->text); 
   $id_str = $list->id_str; 
   $created_at = date("Y年m月d日H時i分s秒",strtotime($list->created_at)); 
   $source = strip_tags($list->source); 

?> 
<tr> 
<td> 
<a href="users_show?screen_name=<?= $screen_name ?>"> 
<img src="<?= $profile_image_url ?>" class="icon"> 
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
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>