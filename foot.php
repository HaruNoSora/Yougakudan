</div> 

<div class="foot"> 
<table> 
<tr> 
<?php 

if(!empty($_SESSION["username"])) 
{ 
 $username = $_SESSION["username"]; 

?> 
<td class="foot"> 
<a href="statuses_home_timeline.php" class="block">ホーム</a> 
</td> 
<td class="foot"> 
<a href="statuses_mentions_timeline.php" class="block">メンション</a> 
</td> 
<td class="foot"> 
<a href="lists_list.php?username=<?= $username ?>" class="block">リスト</a> 
</td> 
<td class="foot"> 
<a href="statuses_update.php" class="block">ツイート</a> 
</div> 
<?php 

} 
else 
{ 
 if($_SERVER["REQUEST_URI"] == "/") 
 { 

?> 
<td class="foot"> 
<a href="login.php" class="block">ログイン</a> 
</td> 
<?php 

 } 
} 

?> 
</td> 
</tr> 
</table> 
</div> 

</body> 

</html>