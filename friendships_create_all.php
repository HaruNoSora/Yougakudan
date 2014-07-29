<?php 

include("oauth.php"); 

$page_title = "片思われを全フォローするやつ"; 
include("head.php"); 

if(isset($_POST["mode"]) && $_POST["mode"] == "run") 
{ 
 $follows = $followers = array(); 
 $object = new oauth(); 
 $param["cursor"] = -1; 
 while($param["cursor"] != 0) 
 { 
  $json = $object->request("GET","friends/ids",$param); 
  foreach($json->ids as $list) 
  { 
   $follows[] = $list; 
  } 
  $param["cursor"] = $json->next_cursor_str; 
 } 
 $param["cursor"] = -1; 
 while($param["cursor"] != 0) 
 { 
  $json = $object->request("GET","followers/ids",$param); 
  foreach($json->ids as $list) 
  { 
   $followers[] = $list; 
  } 
  $param["cursor"] = $json->next_cursor_str; 
 } 
 for($i = 0;$i < count($followers);$i++) 
 { 
  if(!in_array($followers[$i],$follows)) 
  { 
   $params[]["user_id"] = $followers[$i]; 
  } 
 } 
 $json = $object->multi_request("POST","friendships/create",$params); 
 if(empty($json->errors)) 
 { 

?> 
処理が完了しました<br> 
<?php 

 } 
} 
else 
{ 

?> 
<form action="" method="post"> 
<input type="hidden" name="mode" value="run"> 
<input type="submit" class="input_submit" value="実行"> 
</form> 
<br> 
本人確認のため、パスワードを入力してください<br> 
<?php 

} 

include("foot.php"); 

?>