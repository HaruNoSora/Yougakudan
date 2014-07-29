<?php 

$page_title = "エラーが発生しました"; 
include("head.php"); 

if(isset($_GET["code"])) 
{ 
 switch($_GET["code"]) 
 { 
  case "400": 
   $error_code = "BAD REQUEST"; 
   $string = "不正なリクエストを検知しました"; 
   break; 
  case "401": 
   $error_code = "UNAUTHORIZED"; 
   $string = "このページを開くには認証が必要です"; 
   break; 
  case "403": 
   $error_code = "FORBIDDEN"; 
   $string = "アクセスが拒否されています"; 
   break; 
  case "404": 
   $error_code = "NOT FOUND"; 
   $string = "存在しないページです"; 
   break; 
  case "500": 
   $error_code = "INTERNAL SERVER ERROR"; 
   $string = "しばらくお待ちください"; 
   break; 
  case "502": 
   $error_code = "BAD GATEWAY"; 
   $string = "不正なゲートウェイを検知しました"; 
   break; 
  case "503": 
   $error_code = "SERVICE UNAVAILABLE"; 
   $string = "しばらくお待ちください"; 
   break; 
  case "504": 
   $error_code = "GATEWAY TIMEOUT"; 
   $string = "タイムアウトしました"; 
   break; 
 } 
} 
else 
{ 
 $error_code = "メンテナンス中です"; 
 $string = "しばらくお待ちください"; 
} 

?> 
<div class="big centering"> 
‐　<?= $error_code ?>　‐<br> 
<br> 
<?= $string ?><br> 
</div> 
<?php 

include("foot.php"); 

?>