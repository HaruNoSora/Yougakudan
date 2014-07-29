<?php 

include("oauth.php"); 

$page_title = "ツイートの詳細"; 
include("head.php"); 

if(isset($_GET["id"]) && preg_match("/^[0-9]{1,}$/",$_GET["id"])) 
{ 
 $object = new oauth(); 
 $param["id"] = $_GET["id"]; 
 $json = $object->request("GET","statuses/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->user->name; 
  $screen_name = $json->user->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->user->profile_image_url_https); 
  $text = str_replace("\n","<br>\n",$json->text); 
  $id_str = $json->id_str; 
  $created_at = date("Y年m月d日H時i分s秒",strtotime($json->created_at)); 
  $source = strip_tags($json->source); 
  $favorite_count = number_format($json->favorite_count); 
  $retweet_count = number_format($json->retweet_count); 
  $string1 = urlencode(" @" . $screen_name . " "); 
  $string2 = urlencode(" RT @". $screen_name . ": " . $json->text); 

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
<a href="conversation_show?id=<?= $id_str ?>" class="big"><?= $text ?></a><br> 
<?php 

  if(isset($json->entities->media)) 
  { 
   foreach($json->entities->media as $media) 
   { 
    $media_url = $media->media_url_https . ":large"; 

?> 
<a href="<?= $media_url ?>" target="new"><img src="<?= $media_url ?>" class="media"></a> 
<?php 

   } 

?> 
<br> 
<?php 

  } 
  if(isset($json->entities->urls)) 
  { 
   foreach($json->entities->urls as $urls) 
   { 
    $expanded_url = $urls->expanded_url; 

?> 
<a href="<?= $expanded_url ?>" target="new">外部サイト(<?= $expanded_url ?>)</a><br> 
<?php 

   } 
  } 
  if(isset($json->entities->hashtags)) 
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
<?php 

  $json = $object->request("GET","statuses/" . $param["id"] . "/activity/summary",NULL); 
  if(empty($json->errors)) 
  { 
   $favoriters_count = $json->favoriters_count; 
   $retweeters_count = $json->retweeters_count; 
   $repliers_count = $json->repliers_count; 

?> 
<table> 
<tr> 
<td> 
<a href="activity_summary?mode=favorite&id=<?= $id_str ?>" class="block"> 
<span class="big"><?= $favoriters_count ?></span><br> 
お気に入り<br> 
</a> 
</td> 
<td> 
<a href="activity_summary?mode=retweet&id=<?= $id_str ?>" class="block"> 
<span class="big"><?= $retweeters_count ?></span><br> 
リツイート<br> 
</a> 
</td> 
<td> 
<a href="activity_summary?mode=reply&id=<?= $id_str ?>" class="block"> 
<span class="big"><?= $repliers_count ?></span><br> 
リプライ<br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<?php 

  } 

?> 
<table class="table"> 
<tr> 
<td> 
ツイートＩＤ<br> 
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
<tr> 
<td> 
クライアント<br> 
</td> 
<td> 
<?= $source ?><br> 
</td> 
</tr> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="favorites_create?id=<?= $id_str ?>" class="block">お気に入り登録</a> 
</td> 
<td> 
<a href="statuses_retweet?id=<?= $id_str ?>" class="block">リツイート</a> 
</td> 
</tr> 
<tr> 
<td> 
<a href="statuses_update_reply?id=<?= $id_str ?>&string=<?= $string1 ?>" class="block">返信</a> 
</td> 
<td> 
<a href="statuses_update_reply?id=<?= $id_str ?>&string=<?= $string2 ?>" class="block">引用ツイート</a> 
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
<input type="text" name="id" class="input_text" placeholder="ツイートＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>