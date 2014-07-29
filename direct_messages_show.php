<?php 

include("oauth.php"); 

$page_title = "メッセージの詳細"; 
include("head.php"); 

if(isset($_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $object = new oauth(); 
 $param["id"] = $_GET["id"]; 
 $json = $object->request("GET","direct_messages/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->sender->name; 
  $screen_name = $json->sender->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->sender->profile_image_url_https); 
  $text = str_replace("\n","<br>\n",$json->text); 
  $id_str = $json->id_str; 
  $created_at = date("Y年m月d日H時i分s秒",strtotime($json->created_at)); 

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
<span class="big"><?= $text ?></span> 
<?php 

  if(!empty($json->entities->urls)) 
  { 
   foreach($json->entities->urls as $urls) 
   { 
    $expanded_url = $urls->expanded_url; 

?> 
<a href="<?= $expanded_url ?>" target="new">外部サイト（<?= $expanded_url ?>）</a><br> 
<?php 

   } 
  } 
  if(!empty($json->entities->media)) 
  { 
   foreach($json->entities->media as $media) 
   { 
    $media_url = $media->media_url_https . ":large"; 

?> 
<a href="<?= $media_url ?>" target="new"><img src="<?= $media_url ?>" class="media"></a> 
<?php 

   } 
  } 

  if(!empty($json->entities->hashtags)) 
  { 
   foreach($json->entities->hashtags as $hashtags) 
   { 
    $hashtag = $hashtags->text; 

?> 
<a href="search_tweets?query=<?= $hashtag ?>">「<?= $hashtag ?>」でツイート検索</a><br> 
<?php 

   } 
  } 

?> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
メッセージＩＤ<br> 
</td> 
<td> 
<?= $id_str ?><br> 
</td> 
</tr> 
<tr> 
<td> 
送信時刻<br> 
</td> 
<td> 
<?= $created_at ?><br> 
</td> 
</tr> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="direct_messages_new?username=<?= $screen_name ?>" class="block">返信</a>
</td> 
<td> 
<a href="direct_messages_destroy?id=<?= $id_str ?>" class="block">削除</a> 
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
<input type="text" name="id" class="input_text" placeholder="メッセージＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>