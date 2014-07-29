<?php 

include("oauth.php"); 

$page_title = "がぞういちらんのひょうじ"; 
include("head.php"); 

if(isset($_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $param["count"] = 100; 
 $json = $object->request("GET","statuses/media_timeline",$param); 
 if(empty($json->errors)) 
 { 
  foreach($json as $list) 
  { 
   if(isset($list->entities->media)) 
   { 
    foreach($list->entities->media as $media) 
    { 
     $media_url = $media->media_url_https . ":large"; 

?> 
<a href="<?= $media_url ?>" target="new"><img src="<?= $media_url ?>" class="media"></a> 
<?php 

    } 
   } 
  } 
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