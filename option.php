<?php 

include("oauth.php"); 

$page_title = "オプション"; 
include("head.php"); 

?> 
<a href="account_data.php" class="button">アカウントデータ</a> 
<a href="customize.php" class="button">カスタマイズ</a> 
<a href="source_code.php" class="button">ソースコード</a> 
<?php 

if(isset($_SESSION["access_token"],$_SESSION["access_token_secret"])) 
{ 

?> 
<br> 
<a href="logout.php" class="button">ログアウト</a> 
<?php 

} 

include("foot.php"); 

?>