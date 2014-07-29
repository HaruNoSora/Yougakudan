<?php 

include("oauth.php"); 

$page_title = "ダイレクトメッセージボム"; 
include("head.php"); 

if(isset($_GET["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_GET["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_GET["username"]; 
 $json1 = $object->request("GET","users/show",$param); 
 if(empty($json1->errors)) 
 { 
  if(isset($_GET["count"]) && preg_match("/^[0-9]{1,3}$/",$_GET["count"]) && $_GET["count"] <= 100) 
  { 
   $name = $json1->name; 
   $screen_name = $json1->screen_name; 
   $i = 0; 
   $count = $_GET["count"]; 
   while($i < $count) 
   { 
    $time = microtime(); 
    $params[$i]["screen_name"] = $screen_name; 
    $params[$i]["text"] = $time; 
    $i++; 
   } 
   $json2 = $object->multi_request("POST","direct_messages/new",$params); 
   if(empty($json2->errors)) 
   { 

?> 
<?= $name . "(". $screen_name . ")" ?>宛てに<?= $i ?>個のメッセージを送信しました<br> 
<?php 

   } 
  } 
  else 
  { 

?> 
回数の指定がおかしいです<br> 
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