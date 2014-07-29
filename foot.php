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
<a href="statuses_home_timeline.php" class="block">Home</a> 
</td> 
<td class="foot"> 
<a href="statuses_mentions_timeline.php" class="block">Mentions</a> 
</td> 
<td class="foot"> 
<a href="lists_list.php?username=<?= $username ?>" class="block">Listes</a> 
</td> 
<td class="foot"> 
<a href="statuses_update.php" class="block">Nouveau tweet</a> 
</div> 
<?php 

} 
else 
{ 
 if($_SERVER["REQUEST_URI"] == "/") 
 { 

?> 
<td class="foot"> 
<a href="login.php" class="block">Se connecter</a> 
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
