<?php 

include("oauth.php"); 

$page_title = "ツイートまとめるやつ"; 
include("head.php"); 

if(isset($_GET["id"]) && preg_match("/^[0-9-]{1,}$/",$_GET["id"])) 
{ 
 $file = "log/statuses_lookup/" . $_GET["id"]; 
 if(is_file($file)) 
 { 
  $object = new oauth(); 
  $file_data = fopen($file,"r"); 
  flock($file_data,LOCK_EX); 
  $param["id"] = fgets($file_data); 
  fclose($file_data); 
  $json = $object->request("GET","statuses/lookup",$param); 
  if(empty($json->errors)) 
  { 
   foreach($json as $val) 
   { 
    $ids[] = $val->id_str; 
   } 
   array_multisort($ids,SORT_ASC,$json); 

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
データが存在しません<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="get"> 
<input type="text" name="id" class="input_text" placeholder="" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>