<?php 

include("oauth.php"); 

$page_title = "ヘッダーのひょうじ"; 
include("head.php"); 

if(isset($_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json = $object->request("GET","users/profile_banner",$param); 
 if(empty($json->errors)) 
 { 
  foreach($json->sizes as $list) 
  { 
   $url = $list->url; 
   $size = getimagesize("$url"); 

?> 
<?= $size[0] . "×" . $size[1] ?><br> 
<a href="<?= $url ?>" target="new"><img src="<?= $url ?>" class="media"></a><br> 
<br> 
<?php 

  } 
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