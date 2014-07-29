<?php 

include("oauth.php"); 

$page_title = "ソースコード"; 
include("head.php"); 

if(isset($_GET["file"])) 
{ 
 $file = $_GET["file"]; 
 if(file_exists($file) && !is_dir($file)) 
 { 
  highlight_file($file); 
 } 
 else 
 { 

?> 
エラーが発生しました 
<?php 

 } 
} 
else 
{ 
 $dir = opendir("."); 
 while(false !== ($file = readdir($dir))) 
 { 
  if($file != "." && $file != ".." && !is_dir($file)) 
  { 
   $array[] = $file; 
  } 
 }  
 closedir($dir); 
 sort($array); 

?> 
<table class="list"> 
<?php 

 foreach($array as $val) 
 { 

?> 
<tr> 
<td> 
<a href="?file=<?= $val ?>"> 
<?= $val ?> 
</a> 
</td> 
<td> 
<a href="?file=<?= $val ?>"> 
<?= filesize($val)/1000 ?>KB 
</a> 
</td> 
</tr> 
<?php 

 } 

?> 
</table> 
<?php 

} 

include("foot.php"); 

?>