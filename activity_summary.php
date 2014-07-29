<?php 

include("oauth.php"); 

$page_title = "アクティビティ"; 
include("head.php"); 

if(isset($_GET["mode"],$_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $object = new oauth(); 
 $json1 = $object->request("GET","statuses/" . $_GET["id"] . "/activity/summary"); 
 if(empty($json1->errors)) 
 { 
  switch($_GET["mode"]) 
  { 
   case "favorite": 
    $array = $json1->favoriters; 
    break; 
   case "retweet": 
    $array = $json1->retweeters; 
    break; 
   case "reply": 
    $array = $json1->repliers; 
    break; 
  } 
  $param["user_id"] = implode(",",array_slice($array,0,100)); 
  $json2 = $object->request("GET","users/lookup",$param); 
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
} 
else 
{ 

?> 
<form action="" method="get"> 
<select name="mode" class="select"> 
<option value="">▼モードを選択</option> 
<option value="favorite">お気に入り</option> 
<option value="retweet">リツイート</option> 
<option value="reply">リプライ</option> 
</select> 
<input type="text" name="id" class="input_text" placeholder="ツイートＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>