<?php 

include("oauth.php"); 

$page_title = "ツイート検索"; 
include("head.php"); 

if(isset($_GET["query"])) 
{ 
 $object = new oauth(); 
 $param["q"] = $_GET["query"]; 
 $param["count"] = 100; 
 if(isset($_GET["since_id"])) 
 { 
  $param["since_id"] = $_GET["since_id"]; 
 } 
 if(isset($_GET["max_id"])) 
 { 
  $param["max_id"] = $_GET["max_id"]; 
 } 
 $json = $object->request("GET","search/tweets",$param); 
 if(empty($json->errors)) 
 { 

?> 
<table class="list"> 
<?php 

  foreach($json->statuses as $list) 
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
<a href="users_show?username=<?= $screen_name ?>"> 
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
<input type="text" name="query" class="input_text" placeholder="キーワード" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>