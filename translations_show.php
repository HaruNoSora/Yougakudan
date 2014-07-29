<?php 

include("oauth.php"); 

$page_title = "ツイートのほんやく"; 
include("head.php"); 

if(isset($_GET["id"],$_GET["dest"])) 
{ 
 $object = new oauth(); 
 $param["id"] = $_GET["id"]; 
 $param["dest"] = $_GET["dest"]; 
 $json = $object->request("GET","translations/show",$param); 
 if(empty($json->errors)) 
 { 

?> 
<?= $json->text ?><br> 
<?php 

 } 
 else 
 { 

?> 
エラーが はっせい しました<br> 
<?php 

 } 
} 
else 
{ 
 $id = isset($_GET["id"]) ? htmlspecialchars($_GET["id"]) : NULL; 

?> 
<form action="" method="get"> 
<input type="text" name="id" class="input_text" placeholder="ツイートＩＤ" value=""> 
<select name="dest" class="select"> 
<option value="">▼げんごをせんたく</option> 
<option value="ar">ARABIC</option> 
<option value="de">GERMAN</option> 
<option value="en">ENGLISH</option> 
<option value="es">SPANISH</option> 
<option value="fr">FRENCH）</option> 
<option value="it">ITALIAN</option> 
<option value="jp">JAPANESE</option> 
<option value="ko">KOREAN</option> 
<option value="zh-cn">CHINESE</option> 
</select> 
<input type="submit" class="input_submit" value="そうしん"> 
</form> 
<?php 

} 

include("foot.php"); 

?>