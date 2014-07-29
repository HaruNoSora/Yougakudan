<?php 

include("oauth.php"); 

$page_title = "リストの詳細"; 
include("head.php"); 

if(isset($_GET["list_id"]) && preg_match("/^[0-9]{1,}$/",$_GET["list_id"])) 
{ 
 $object = new oauth(); 
 $param["list_id"] = $_GET["list_id"]; 
 $json = $object->request("GET","lists/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->user->name; 
  $screen_name = $json->user->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->user->profile_image_url_https); 
  $list_name = $json->name; 
  $list_id_str = $json->id_str; 
  $description = $json->description; 
  $member_count = number_format($json->member_count); 
  $subscriber_count = number_format($json->subscriber_count); 
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
<span class="big"><?= $list_name . "：" . $description ?></span><br> 
</td> 
</tr> 
</table> 
<br> 
<table> 
<tr> 
<td> 
<a href="lists_members?list_id=<?= $list_id_str ?>" class="block"> 
<span class="big"><?= $member_count ?></span><br> 
メンバー<br> 
</a> 
</td> 
<td> 
<a href="lists_subscribers?list_id=<?= $list_id_str ?>" class="block"> 
<span class="big"><?= $subscriber_count ?></span><br> 
保存<br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
リストＩＤ<br> 
</td> 
<td> 
<?= $list_id_str ?><br> 
</td> 
</tr> 
<tr> 
<td> 
リスト作成日<br> 
</td> 
<td> 
<?= $created_at ?><br> 
</td> 
</tr> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td colspan="2"> 
<a href="lists_statuses?list_id=<?= $list_id_str ?>" class="block">タイムライン</a> 
</td> 
</tr> 
<tr> 
<td> 
<a href="lists_members_create?list_id=<?= $list_id_str ?>" class="block">メンバーの追加</a> 
</td> 
<td> 
<a href="lists_members_destroy?list_id=<?= $list_id_str ?>" class="block">メンバーの除外</a> 
</td> 
</tr> 
<tr> 
<td> 
<a href="lists_subscribers_create?list_id=<?= $list_id_str ?>" class="block">リストを購読</a> 
</td> 
<td> 
<a href="lists_subscribers_destroy?list_id=<?= $list_id_str ?>" class="block">リストを解約</a> 
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
<input type="text" name="list_id" class="input_text" placeholder="リストＩＤ" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>