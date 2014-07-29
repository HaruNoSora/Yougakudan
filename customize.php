<?php 

include("oauth.php"); 

$page_title = "Personnaliser"; 
include("head.php"); 

if(isset($_GET["theme"])) 
{ 
 switch($_GET["theme"]) 
 { 
  case "default": 
   $array["background_color"] = NULL; 
   $array["border_color"] = NULL; 
   $array["font_color"] = NULL; 
   $array["link_color"] = NULL; 
   break; 
  case "0001": 
   $array["background_color"] = "255,200,200"; 
   $array["border_color"] = "#ff8888"; 
   $array["font_color"] = "#bb4444"; 
   $array["link_color"] = "255,255,255"; 
   break; 
  case "0002": 
   $array["background_color"] = "200,200,255"; 
   $array["border_color"] = "#8888ff"; 
   $array["font_color"] = "#4444bb"; 
   $array["link_color"] = "255,255,255"; 
   break; 
  case "0003": 
   $array["background_color"] = "255,150,100"; 
   $array["border_color"] = "#bb4400"; 
   $array["font_color"] = "#884400"; 
   $array["link_color"] = "255,255,255"; 
   break; 
  case "0004": 
   $array["background_color"] = "200,200,200"; 
   $array["border_color"] = "#888888"; 
   $array["font_color"] = "#444444"; 
   $array["link_color"] = "255,255,255"; 
   break; 
  case "0005": 
   $array["background_color"] = "50,50,50"; 
   $array["border_color"] = "#000000"; 
   $array["font_color"] = "#ffffff"; 
   $array["link_color"] = "128,128,128"; 
   break; 
 } 
 $expire = 2147483647; 
 foreach($array as $key => $val) 
 { 
  if(isset($val)) 
  { 
   setcookie("CSS"."[$key]",$val,$expire); 
  } 
  else 
  { 
   setcookie("CSS"."[$key]",NULL,NULL); 
  } 
 } 
 header("location:customize"); 
 exit; 
} 
else 
{ 

?> 
<form action="" method="get"> 
<select name="theme" class="select"> 
<option value="">▼ Sélectionnez une rubrique</option> 
<option value="default">Default</option> 
<?php 

 for($i = 1;$i <= 5;$i++) 
 { 
  $theme_id = sprintf("%04s",$i); 

?> 
<option value="<?= $theme_id ?>">THEME_<?= $theme_id ?></option> 
<?php 

 } 

?> 
</select> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

} 

include("foot.php"); 

?>