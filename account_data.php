<?php 

include("oauth.php"); 

$page_title = "Données du compte"; 
include("head.php"); 

$i_max = 1000; 

if(isset($_POST["data_id"]) && $_POST["data_id"] > 0 && $_POST["data_id"] <= $i_max) 
{ 
 $data_id = $_POST["data_id"]; 
 if(isset($_POST["mode"]) && $_POST["mode"] === "create") 
 { 
  $id = md5(uniqid(mt_rand())); 
  $file = "log/accounts/" . $id; 
  if(!file_exists($file)) 
  { 
   $data = $_SESSION["name"] ."\t". $_SESSION["username"] ."\t". $_SESSION["consumer_key"] ."\t". $_SESSION["consumer_secret"] ."\t". $_SESSION["access_token"] ."\t". $_SESSION["access_token_secret"]; 
   $fp = fopen($file,"w+"); 
   flock($fp,LOCK_EX); 
   fwrite($fp,$data); 
   fclose($fp); 
   $_SESSION["accounts"][$data_id] = $id; 
  } 
 } 
 if(isset($_POST["mode"]) && $_POST["mode"] === "destroy") 
 { 
  $id = $_SESSION["accounts"][$data_id]; 
  $file = "log/accounts/" . $id; 
  if(file_exists($file)) 
  { 
   unlink($file); 
   unset($_SESSION["accounts"][$data_id]); 
  } 
 } 
 header("location:account_data"); 
 exit; 
} 
else 
{ 

?> 
<form action="login" method="post"> 
<select name="data_id" class="select"> 
<option value="">▼ Choisissez un compte</option> 
<?php 

 for($i = 1;$i <= $i_max;$i++) 
 { 
  if(isset($_SESSION["accounts"][$i])) 
  { 
   $id = $_SESSION["accounts"][$i]; 
   $file = "log/accounts/" . $id; 
   $fp = fopen($file,"r"); 
   $data = explode("\t",fgets($fp)); 
   fclose($fp); 

?> 
<option value="<?= $i ?>">DATA_<?= sprintf("%04s",$i) ?>：<?= $data[0] ?>(<?= $data[1] ?>)</option> 
<?php 

  } 
  else 
  { 

?> 
<option value="" disabled>DATA_<?= sprintf("%04s",$i) ?>：Vacances</option> 
<?php 

  } 
 } 

?> 
</select> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

 if(isset($_SESSION["access_token"],$_SESSION["access_token_secret"])) 
 { 

?> 
<br> 
<br> 
<br> 
<form action="" method="post"> 
<input type="hidden" name="mode" value="create"> 
<select name="data_id" class="select"> 
<option value="">▼ Inscription du compte</option> 
<?php 

  for($i = 1;$i <= $i_max;$i++) 
  { 
   if(isset($_SESSION["accounts"][$i])) 
   { 
    $id = $_SESSION["accounts"][$i]; 
    $file = "log/accounts/" . $id; 
    $fp = fopen($file,"r"); 
    $data = explode("\t",fgets($fp)); 
    fclose($fp); 

?> 
<option value="" disabled>DATA_<?= sprintf("%04s",$i) ?>：<?= $data[0] ?>(<?= $data[1] ?>)</option> 
<?php 

   } 
   else 
   { 

?> 
<option value="<?= $i ?>">DATA_<?= sprintf("%04s",$i) ?>：Vacances</option> 
<?php 

   } 
  } 

?> 
</select> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<br> 
<form action="" method="post"> 
<input type="hidden" name="mode" value="destroy"> 
<select name="data_id" class="select"> 
<option value="">▼ Inscription du compte</option> 
<?php 

  for($i = 1;$i <= $i_max;$i++) 
  { 
   if(isset($_SESSION["accounts"][$i])) 
   { 
    $id = $_SESSION["accounts"][$i]; 
    $file = "log/accounts/" . $id; 
    $fp = fopen($file,"r"); 
    $data = explode("\t",fgets($fp)); 
    fclose($fp); 

?> 
<option value="<?= $i ?>">DATA_<?= sprintf("%04s",$i) ?>：<?= $data[0] ?>(<?= $data[1] ?>)</option> 
<?php 

   } 
   else 
   { 

?> 
<option value="" disabled>DATA_<?= sprintf("%04s",$i) ?>：Vacances</option> 
<?php 

   } 
  } 

?> 
</select> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

 } 
} 

include("foot.php"); 

?>