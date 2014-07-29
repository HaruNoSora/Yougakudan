<?php 

include("oauth.php"); 

$page_title = "ふぁぼむらいん"; 
include("head.php"); 

if(isset($_GET["count"]) && preg_match("/^[0-9]{1,3}$/",$_GET["count"]) && $_GET["count"] <= 100) 
{ 
 $i = 0; 
 $object = new oauth(); 
 $param["count"] = $_GET["count"]; 
 $json1 = $object->request("GET","statuses/home_timeline",$param); 
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