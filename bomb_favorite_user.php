<?php 

include("oauth.php"); 

$page_title = "ゆーざーふぁぼむらいん"; 
include("head.php"); 

if(isset($_GET["username"],$_GET["count"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"]) && preg_match("/^[0-9]{1,3}$/",$_GET["count"]) && $_GET["count"] <= 100) 
{ 
 $i = 0; 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $param["count"] = $_GET["count"]; 
 $json1 = $object->request("GET","statuses/user_timeline",$param); 
 if(empty($json1->errors)) 
 { 
  foreach($json1 as $list) 
  { 
   $params[$i]["id"] = $list->id_str; 
   $i++; 
  } 
  $json2 = $object->multi_request("POST","favorites/create",$params); 
  if(empty($json2->errors)) 
  { 

?> 
<?= $i ?>個のツイートをお気に入り登録しました<br> 
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
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value=""> 
<select name="count" class="select"> 
<option value="">▼回数を選択</option> 
<option value="10">10回</option> 
<option value="50">50回</option> 
<option value="100">100回</option> 
</select> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>