<?php 

include("oauth.php"); 

$page_title = "レートリミット"; 
include("head.php"); 

$object = new oauth(); 
$json = $object->request("GET","application/rate_limit_status"); 
if(empty($json->errors)) 
{ 
 $resources = $json->resources; 
 foreach($resources as $api) 
 { 
  foreach($api as $key => $val) 
  { 
   $keys[$key]["limit"] = $val->limit; 
   $keys[$key]["remaining"] = $val->remaining; 
  } 
 } 
 ksort($keys); 

?> 
<table class="table"> 
<?php 

 foreach($keys as $key => $val) 
 { 
  $key = substr($key,1); 
  $limit = sprintf("%04d",$val["limit"]); 
  $remaining = sprintf("%04d",$val["remaining"]); 

?> 
<tr> 
<td> 
<?= $key ?><br> 
</td> 
<td> 
<?= $remaining ?>／<?= $limit ?><br> 
</td> 
</tr> 
<?php 

 } 

?> 
</table> 
<?php 

} 
else 
{ 

?> 
エラーが発生しました<br> 
<?php 

} 

include("foot.php"); 

?>