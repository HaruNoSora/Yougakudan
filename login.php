<?php 

include("oauth.php"); 

$page_title = "ログイン"; 
include("head.php"); 

if(isset($_POST["client"],$_POST["username"],$_POST["password"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_POST["username"])) 
{ 
 switch($_POST["client"]) 
 { 
  case "android": 
   $consumer_key = "3nVuSoBZnx6U4vzUxf5w"; 
   $consumer_secret = "Bcs59EFbbsdF6Sl9Ng71smgStWEGwXXKSjYvPVt7qys"; 
   break; 
  case "google_tv": 
   $consumer_key = "iAtYJ4HpUVfIUoNnif1DA"; 
   $consumer_secret = "172fOpzuZoYzNYaU3mMYvE8m8MEyLbztOdbrUolU"; 
   break; 
  case "ipad": 
   $consumer_key = "CjulERsDeqhhjSme66ECg"; 
   $consumer_secret = "IQWdVyqFxghAtURHGeGiWAsmCAGmdW3WmbEx6Hck"; 
   break; 
  case "iphone": 
   $consumer_key = "IQKbtAYlXLripLGPWd0HUA"; 
   $consumer_secret = "GgDYlkSvaPxGxC4X8liwpUoqKwwr3lCADbz8A7ADU"; 
   break; 
  case "mac": 
   $consumer_key = "3rJOl1ODzm9yZy63FACdg"; 
   $consumer_secret = "5jPoQ5kQvMJFDYRNE8bQ4rHuds4xJqhvgNJM4awaE8"; 
   break; 
  case "windows": 
   $consumer_key = "TgHNMa7WZE7Cxi1JbkAMQ"; 
   $consumer_secret = "SHy9mBMBPNj3Y17et9BF4g5XeqS4y3vkeW24PttDcY"; 
   break; 
  case "windows_phone": 
   $consumer_key = "yN3DUNVO0Me63IAQdhTfCA"; 
   $consumer_secret = "c768oTKdzAjIYCmpSNIdZbGaG0t6rOhSFQP0S5uC79g"; 
   break; 
  case "tweetdeck": 
   $consumer_key = "yT577ApRtZw51q4NPMPPOQ"; 
   $consumer_secret = "3neq3XqN5fO3obqwZoajavGFCUrC42ZfbrLXy5sCv8"; 
   break; 
 } 
 $object = new oauth($consumer_key,$consumer_secret); 
 $param["username"] = $_POST["username"]; 
 $param["password"] = $_POST["password"]; 
 $token = $object->oauth($param); 
 if(isset($token["oauth_token"],$token["oauth_token_secret"])) 
 { 
  $object = new oauth(); 
  $json = $object->request("GET","account/verify_credentials"); 
  if(empty($json->errors)) 
  { 
   $_SESSION["name"] = $json->name; 
   $_SESSION["username"] = $json->screen_name; 
  } 
 } 
 header("location:/"); 
 exit; 
} 
else if(isset($_POST["data_id"])) 
{ 
 if(isset($_SESSION["accounts"][$_POST["data_id"]])) 
 { 
  $id = $_SESSION["accounts"][$_POST["data_id"]]; 
  $file = "log/accounts/". $id; 
  $fp = fopen($file,"r"); 
  $data = explode("\t",fgets($fp)); 
  fclose($fp); 
  $object = new oauth($data[2],$data[3],$data[4],$data[5]); 
  $json = $object->request("GET","account/verify_credentials"); 
  if(empty($json->errors)) 
  { 
   $_SESSION["name"] = $json->name; 
   $_SESSION["username"] = $json->screen_name; 
  } 
 } 
 header("location:/"); 
 exit; 
} 
else 
{ 
 $username = isset($_POST["username"]) && preg_match("/^[0-9a-zA-Z_]{1,15}$/",$_POST["username"]) ? $_POST["username"] : NULL; 

?> 
<form action="" method="post"> 
<select name="client" class="select"> 
<option value="">▼クライアントを選択</option> 
<option value="android">Twitter for Android</option> 
<option value="google_tv">Twitter for Google TV</option> 
<option value="ipad">Twitter for iPad</option> 
<option value="iphone">Twitter for iPhone</option> 
<option value="mac">Twitter for Mac</option> 
<option value="windows">Twitter for Windows</option> 
<option value="windows_phone">Twitter for Windows Phone</option> 
<option value="tweetdeck">TweetDeck</option> 
</select> 
<input type="text" name="username" class="input_text" placeholder="ユーザーネーム" value="<?= $username ?>"> 
<input type="password" name="password" class="input_text" placeholder="パスワード" value=""> 
<input type="submit" class="input_submit" value="送信"> 
</form> 
<?php 

} 

include("foot.php"); 

?>