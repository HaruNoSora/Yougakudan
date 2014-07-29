<?php 

include("oauth.php"); 

$page_title = "Modifier le profil"; 
include("head.php"); 

if(isset($_GET["name"],$_GET["description"],$_GET["url"],$_GET["location"])) 
{ 
 $param["name"] = $_GET["name"]; 
 $param["description"] = $_GET["description"]; 
 $param["url"] = $_GET["url"]; 
 $param["location"] = $_GET["location"]; 
 $object = new oauth(); 
 $json = $object->request("POST","account/update_profile",$param); 
 if(empty($json->errors)) 
 { 
  header("location:/"); 
 } 
 else 
 { 

?> 
Une erreur est survenue.<br> 
<?php 

 } 
} 
else 
{ 
 $param["screen_name"] = $_SESSION["username"]; 
 $object = new oauth(); 
 $json = $object->request("GET","users/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->name; 
  $description = isset($json->description) ? $json->description : NULL; 
  $url = isset($json->entities->url->urls[0]->expanded_url) ? $json->entities->url->urls[0]->expanded_url : NULL; 
  $location = isset($json->location) ? $json->location : NULL; 

?> 
<form action="" method="get"> 
<input type="text" name="name" class="input_text" placeholder="Nom" value="<?= $name ?>"> 
<input type="text" name="description" class="input_text" placeholder="Biographie" value="<?= $description ?>"> 
<input type="text" name="url" class="input_text" placeholder="Site Web" value="<?= $url ?>"> 
<input type="text" name="location" class="input_text" placeholder="Location" value="<?= $location ?>"> 
<input type="submit" class="input_submit" value="Go"> 
</form> 
<?php 

 } 
 else 
 { 

?> 
Une erreur est survenue.<br> 
<?php 

 } 
} 

include("foot.php"); 

?>