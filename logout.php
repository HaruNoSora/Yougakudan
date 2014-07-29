<?php 

include("oauth.php"); 

unset($_SESSION["consumer_key"],$_SESSION["consumer_secret"],$_SESSION["access_token"],$_SESSION["access_token_secret"],$_SESSION["name"],$_SESSION["username"]); 
header("location:/"); 
exit; 

?>