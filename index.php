<?php 

include("oauth.php"); 

$page_title = "トップページ"; 
include("head.php"); 

if(isset($_SESSION["username"])) 
{ 
 $object = new oauth(); 
 $param["screen_name"] = $_SESSION["username"]; 
 $json = $object->request("GET","users/show",$param); 
 if(empty($json->errors)) 
 { 
  $name = $json->name; 
  $screen_name = $json->screen_name; 
  $profile_img = str_replace("_normal.",".",$json->profile_image_url_https); 
  $description = isset($json->description) ? $json->description : NULL; 
  $statuses_count = number_format($json->statuses_count); 
  $friends_count = number_format($json->friends_count); 
  $followers_count = number_format($json->followers_count); 
  $favourites_count = number_format($json->favourites_count); 
  $listed_count = number_format($json->listed_count); 
  $location = isset($json->location) ? $json->location : NULL; 
  $url = isset($json->entities->url->urls[0]->expanded_url) ? $json->entities->url->urls[0]->expanded_url : NULL; 
  $id_str = $json->id_str; 
  $created_at = date("Y年m月d日H時i分s秒",strtotime($json->created_at)); 

?> 
<table> 
<tr> 
<td class="centering"> 
<a href="<?= $profile_img ?>" class="block" target="new"> 
<img src="<?= $profile_img ?>" class="icon"><br> 
<span class="big bold"><?= $name ?></span>　<?= $screen_name ?><br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
<span class="big"><?= $description ?></span><br> 
</td> 
</tr> 
</table> 
<br> 
<table> 
<tr> 
<td> 
<a href="statuses_user_timeline.php?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $statuses_count ?></span><br> 
ツイート<br> 
</a> 
</td> 
<td> 
<a href="friends_list.php?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $friends_count ?></span><br> 
フォロー<br> 
</a> 
</td> 
<td> 
<a href="followers_list.php?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $followers_count ?></span><br> 
フォロワー<br> 
</a> 
</td> 
<td> 
<a href="favorites_list.php?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $favourites_count ?></span><br> 
お気に入り<br> 
</a> 
</td> 
<td> 
<a href="lists_memberships.php?username=<?= $screen_name ?>" class="block"> 
<span class="big"><?= $listed_count ?></span><br> 
リスト<br> 
</a> 
</td> 
</tr> 
</table> 
<br> 
<table class="table"> 
<tr> 
<td> 
位置情報<br> 
</td> 
<td> 
<?= $location ?><br> 
</td> 
</tr> 
<tr> 
<td> 
ＵＲＬ<br> 
</td> 
<td> 
<?= $url ?><br> 
</td> 
</tr> 
<tr> 
<td> 
アカウントＩＤ<br> 
</td> 
<td> 
<?= $id_str ?><br> 
</td> 
</tr> 
<tr> 
<td> 
アカウント作成日<br> 
</td> 
<td> 
<?= $created_at ?><br> 
</td> 
</tr> 
</table> 
<br> 
<table class="centering"> 
<tr> 
<td> 
<a href="account_update_profile.php" class="block">プロフィールの編集</a> 
</td> 
</tr> 
</table> 
<?php 

 } 
} 
else 
{ 

?> 
<div class="big bold centering"> 
‐　こんにちは、ヴェネッターへようこそ！　‐<br> 
</div> 
<br> 
<p class="block_title">はじめに</p> 
「ヴェネッター」とは、<a href="https://twitter.com/venethis">ヴェネティス(@venethis)</a>が開発しているTwitterの多機能アプリケーションなのです。アカウントをお持ちのかたであれば、今すぐ無料でご利用いただけちゃいますよ～。<br> 
<br> 
<p class="block_title">充実している機能</p> 
各種タイムラインの表示・リスト管理・アカウント検索といった標準的な機能はもちろん、ツイートボムなどヴェネッターだけのユニークなツールも豊富に取り揃えております。<br> 
<br> 
<p class="block_title">いつでもどこでも</p> 
ヴェネッターは、インターネット上で動作するウェブアプリケーションなのです。パソコン・タブレット・スマートフォン・ガラケー・ゲーム機などなど……とにかくインターネットブラウザーを搭載している機器であれば何でも使えてしまいます。<br> 
<br> 
<p class="block_title">パソコンなのに「Twitter for iPhone」</p> 
ヴェネッターでは、公式クライアントの認証コードを用いてアプリ連携するというスペシャルなテクニックを取り入れておりますよ。要するにクライアント名のカムフラージュが可能なんですね～。<br> 
<br> 
<p class="block_title">ＡＰＩ制限？なにそれおいしいの？</p> 
各種ＡＰＩの上限は公式クライアントのものが適用されるため、普通に使用するだけならＡＰＩ制限にかかることはほぼナッシングといってもよいです。<br> 
<br> 
<p class="block_title">マルチアカウント機能が超便利</p> 
複数のアカウントをお持ちの場合は「アカウントデータ」に登録しておくと、毎回ログイン／ログアウトする必要がなくなり簡単にアカウントを切替えられます。<br> 
<br> 
<p class="block_title">色鮮やかなデザイン</p> 
ヴェネッターは複数の配色パターンを用意しており、利用者の好みに合わせてチェンジすることができます。<br> 
<a href="extra/design_1" target="new"><img src="extra/design_1" class="media"></a> 
<a href="extra/design_2" target="new"><img src="extra/design_2" class="media"></a> 
<a href="extra/design_3" target="new"><img src="extra/design_3" class="media"></a> 
<a href="extra/design_4" target="new"><img src="extra/design_4" class="media"></a><br> 
<br> 
<p class="block_title">独自開発のライブラリを採用</p> 
Twitterでは世界中のデベロッパー達により様々なOAuthライブラリが提供されておりますが、ヴェネッターはそんなものには頼らずゼロの状態からシステムを構築しましたよ。<br> 
<br> 
<p class="block_title">オープンソース</p> 
ヴェネッターでは、利用者の皆様にプログラミングの楽しさを感じていただくため、全てのソースコードを無償公開しているのであります。<br> 
<br> 
<p class="block_title">注意事項</p> 
ヴェネッターのコンテンツを使用したことによって生じた損害について、当方は一切保証しませんのでよく考えてから利用してくださいね。<br> 
<br> 
<p class="block_title">お問い合わせ</p> 
ヴェネッターに関するご質問・ご要望は<a href="https://twitter.com/venethis">ヴェネティス(@venethis)</a>にて受付けておりますよ～。<br> 
<br> 
<p class="block_title">ログイン方法</p> 
①「▼クライアントを選択」でTwitterと連携するクライアントを設定<br> 
②「ユーザーネーム」「パスワード」にご自身のアカウント情報を入力（@は不要です）<br> 
③「送信」をクリック<br> 
④ログインに成功すると、ご自身のアカウントページが表示されます<br> 
<a href="extra/login_1" target="new"><img src="extra/login_1" class="media"></a>→ 
<a href="extra/login_2" target="new"><img src="extra/login_2" class="media"></a>→ 
<a href="extra/login_3" target="new"><img src="extra/login_3" class="media"></a><br> 
※画像はフィクションなのです<br> 
<?php 

} 

include("foot.php"); 

?>