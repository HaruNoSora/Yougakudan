<?php 

include("oauth.php"); 

$page_title = "アカウント"; 
include("head.php"); 

if(isset($_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("GET","users/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->name; 
  $screen_name = $json->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->profile_image_url_https); 
  $description = $json->description; 
  $statuses_count = $json->statuses_count; 
  $friends_count = $json->friends_count; 
  $followers_count = $json->followers_count; 
  $favourites_count = $json->favourites_count; 
  $listed_count = $json->listed_count; 
  $location = $json->location; 
  $url = isset($json->entities->url->urls[0]->expanded_url) ? $json->entities->url->urls[0]->expanded_url : NULL; 
  $id_str = $json->id_str; 
  $created_at = date("Y/m/d-H:i:s",strtotime($json->created_at)); 
  $sec = time() - strtotime($json->created_at); 
  $day = ceil($sec / 86400); 
  $string = urlencode(" @" . $screen_name); 

?> 
<table class="centering"> 
<tr> 
<td> 
<a href="<?= $profile_img ?>" class="block" target="new"> 
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
<span class="big"><?= $description ?></span><br> 
</td> 
</tr> 
</table> 
<br> 
<table> 
<tr> 
<td> 
<a href="statuses_user_timeline?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $statuses_count ?></span><br> 
ツイート<br> 
</a> 
</td> 
<td> 
<a href="friends_list?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $friends_count ?></span><br> 
フォロー<br> 
</a> 
</td> 
<td> 
<a href="followers_list?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $followers_count ?></span><br> 
フォロワー<br> 
</a> 
</td> 
<td> 
<a href="favorites_list?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $favourites_count ?></span><br> 
おきにいり<br> 
</a> 
</td> 
<td> 
<a href="lists_memberships?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $listed_count ?></span><br> 
リスト<br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
いちじょうほう<br> 
</td> 
<td> 
<?= $location ?><br> 
</td> 
</tr> 
<tr> 
<td> 
ゆーあーるえる<br> 
</td> 
<td> 
<?= $url ?><br> 
</td> 
</tr> 
<tr> 
<td> 
アカウントＩＤ<br> 
</td> 
<td> 
<?= $id_str ?><br> 
</td> 
</tr> 
<tr> 
<td> 
アカウントさくせいび<br> 
</td> 
<td> 
<?= $created_at ?><br> 
</td> 
</tr> 
<tr> 
<td> 
Ｔｗｉｔｔｅｒれき<br> 
</td> 
<td> 
<?= $day ?>にち（<?= $sec ?>びょう）<br> 
</td> 
</tr> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td colspan="2"> 
<a href="statuses_update?string=<?= $string ?>" class="block">ツイートのそうしん</a> 
</td> 
</tr> 
<tr> 
<td> 
<a href="friendships_create?username=<?= $screen_name ?>" class="block">フォロー</a> 
</td> 
<td> 
<a href="friendships_destroy?username=<?= $screen_name ?>" class="block">リムーブ</a> 
</td> 
</tr> 
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
<input type="submit" class="input_submit" value="そうしん"> 
</form> 
<?php 

} 

include("foot.php"); 

?>