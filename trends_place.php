<?php 

include("oauth.php"); 

$page_title = "トレンドけんさく"; 
include("head.php"); 

if(isset($_GET["id"])) 
{ 
 $object = new oauth(); 
 $param["id"] = $_GET["id"]; 
 $json = $object->request("GET","trends/place",$param); 
 if(empty($json->errors)) 
 { 
  $trend = $json[0]->trends; 
  foreach($trend as $list) 
  { 
   $name = $list->name; 
   $url = urlencode($name); 

?> 
<a href="search_tweets?query=<?= $url ?>"><?= $name ?></a><br> 
<?php 

  } 
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

?> 
<form action="" method="get"> 
<select name="id" class="select"> 
<option value="">▼ちいきをせんたく</option> 
<option value="1">せかい</option> 
<option value="23424738">アラブ</option> 
<option value="23424748">オーストラリア</option> 
<option value="23424768">ブラジル</option> 
<option value="23424775">カナダ</option> 
<option value="23424800">ドミニカ</option> 
<option value="23424802">エジプト</option> 
<option value="23424819">フランス</option> 
<option value="23424846">インドネシア</option> 
<option value="23424848">インド</option> 
<option value="23424853">イタリア</option> 
<option value="23424856">にっぽん</option> 
<option value="23424863">ケニア</option> 
<option value="23424868">かんこく</option> 
<option value="23424873">レバノン</option> 
<option value="23424900">メキシコ</option> 
<option value="23424916">ニュージーランド</option> 
<option value="23424922">パキスタン</option> 
<option value="23424936">ロシア</option> 
<option value="23424948">シンガポール</option> 
<option value="23424975">イギリス</option> 
<option value="23424977">アメリカ</option> 
<option value="23424982">ベネズエラ</option> 
</select> 
<input type="submit" class="input_submit" value="そうしん"> 
</form> 
<?php 

} 

include("foot.php"); 

?>