<?php 

$background_color = isset($_COOKIE["CSS"]["background_color"]) ? $_COOKIE["CSS"]["background_color"] : "200,200,255"; 
$border_color = isset($_COOKIE["CSS"]["border_color"]) ? $_COOKIE["CSS"]["border_color"] : "#8888ff"; 
$font_color = isset($_COOKIE["CSS"]["font_color"]) ? $_COOKIE["CSS"]["font_color"] : "#4444bb"; 
$font_size = 24; 
$link_color = isset($_COOKIE["CSS"]["link_color"]) ? $_COOKIE["CSS"]["link_color"] : "255,255,255"; 

?> 
<!DOCTYPE HTML> 

<html lang="ja"> 

<head> 

<meta charset="UTF-8"> 
<meta name="viewport" content="user-scalable=no"> 

<style> 
* 
{ 
 box-sizing:border-box; 
 color:<?= $font_color ?>; 
 cursor:default; 
 font-family:sans-serif; 
 font-size:<?= $font_size ?>px; 
 line-height:150%; 
 margin:0px; 
 padding:0px; 
 word-break:break-all; 
 -webkit-appearance:none; 
 -webkit-overflow-scrolling:touch; 
 -webkit-text-size-adjust:100%; 
} 
*.block 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
 display:block; 
 padding:10px; 
} 
*.button 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
 border:3px <?= $border_color ?> solid; 
 display:block; 
 font-size:<?= $font_size + 5 ?>px; 
 margin:0px 0px 20px 0px; 
 padding:10px; 
 text-align:center; 
} 
*.block:hover,*.button:hover 
{ 
 background:rgba(<?= $link_color ?>,0.5); 
} 
*.centering 
{ 
 text-align:center; 
} 
*.small 
{ 
 font-size:<?= $font_size - 5 ?>px; 
} 
*.big 
{ 
 font-size:<?= $font_size + 5 ?>px; 
} 
*.bold 
{ 
 font-weight:bold; 
} 
html 
{ 
 background:rgb(<?= $background_color ?>); 
} 
body 
{ 
 overflow-x:hidden; 
 overflow-y:scroll; 
} 
div.head 
{ 
 position:fixed; 
 text-align:center; 
 top:0; 
 width:100%; 
} 
div.body 
{ 
 padding:100px 0px 100px 0px; 
} 
div.foot 
{ 
 bottom:0; 
 position:fixed; 
 text-align:center; 
 width:100%; 
} 
p.block_menu,p.block_title 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
 border:3px <?= $border_color ?> solid; 
 font-size:<?= $font_size + 5 ?>px; 
 padding:10px; 
} 
p.block_title 
{ 
 margin:0px 0px 10px 0px; 
} 
a 
{ 
 font-size:inherit; 
 text-decoration:none; 
} 
input.input_text,input.input_submit,select,textarea 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
 border:3px <?= $border_color ?> solid; 
 display:block; 
 line-height:100%; 
 margin:0px 0px 20px 0px; 
 overflow-y:hidden; 
 padding:20px; 
 width:100%; 
} 
input.input_submit 
{ 
 letter-spacing:50px; 
 text-indent:50px; 
} 
input:hover,select:hover,textarea:hover 
{ 
 background:rgba(<?= $link_color ?>,0.5); 
} 
input:focus,select:focus,textarea:focus 
{ 
 background:rgba(<?= $link_color ?>,0.5); 
} 
textarea.textarea 
{ 
 height:200px; 
} 
table 
{ 
 border-collapse:collapse; 
 table-layout:fixed; 
 width:100%; 
} 
tr,td 
{ 
 border:3px <?= $border_color ?> solid; 
 vertical-align:top; 
} 
table.table td 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
 padding:10px; 
} 
table.list 
{ 
 table-layout:auto; 
} 
table.list tr 
{ 
 background:rgba(<?= $link_color ?>,0.8); 
} 
table.list tr:hover 
{ 
 background:rgba(<?= $link_color ?>,0.5); 
} 
table.list td 
{ 
 border:none; 
} 
table.list a,p 
{ 
 display:block; 
 padding:10px; 
} 
td.wide 
{ 
 width:100%; 
} 
td.head_main,td.head_sub,td.foot 
{ 
 font-size:<?= $font_size + 5 ?>px; 
 font-weight:bold; 
 letter-spacing:10px; 
 text-indent:10px; 
} 
td.head_main 
{ 
 width:70%; 
} 
td.head_sub 
{ 
 width:15%; 
} 
dl dd 
{ 
 margin:0px 0px 0px 20px; 
} 
img 
{ 
 border:3px <?= $border_color ?> solid; 
 vertical-align:middle; 
} 
img.icon 
{ 
 height:100px; 
 width:100px; 
} 
img.media 
{ 
 height:auto; 
 margin:10px; 
 width:20%; 
} 
</style> 

<title>ヴェネッター</title> 

</head> 

<body> 

<div class="head"> 
<table> 
<tr> 
<td class="head_sub"> 
<a href="menu.php" class="block">≡</a> 
</td> 
<td class="head_main"> 
<a href="/" class="block"><?= $page_title ?></a> 
</td> 
<td class="head_sub"> 
<a href="option.php" class="block">≡</a> 
</td> 
</tr> 
</table> 
</div> 

<div class="body"> 