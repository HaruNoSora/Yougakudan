<?php 

include("oauth.php"); 

$page_title = "メインメニュー"; 
include("head.php"); 

?> 
<p class="block_menu.php">Chronologie</p> 
<a href="statuses_home_timeline.php" class="block">Accueil Calendrier</a> 
<a href="statuses_mentions_timeline.php" class="block">Application Hommes Timeline</a> 
<a href="statuses_user_timeline.php" class="block">Timeline de l'utilisateur</a> 
<a href="statuses_media_timeline.php" class="block">Médias</a> 
<a href="lists_statuses.php" class="block">Liste Chronologie</a> 
<a href="trends_timeline.php" class="block">Top Trends</a> 
<p class="block_menu.php">Compte</p> 
<a href="users_show.php" class="block">Block</a> 
<a href="account_update_profile.php" class="block">Modifier le profil</a> 
<a href="friends_list.php" class="block">フォローリスト</a> 
<a href="followers_list.php" class="block">フォロワーリスト</a> 
<a href="mutes_users_list.php" class="block">ミュートリスト</a> 
<a href="blocks_list.php" class="block">ブロックリスト</a> 
<a href="lists_ownerships.php" class="block">リストオーナーシップ</a> 
<a href="lists_memberships.php" class="block">リストメンバーシップ</a> 
<a href="lists_subscriptions.php" class="block">保存しているリスト</a> 
<a href="friendships_incoming.php" class="block">フォロー保留中リスト</a> 
<a href="friendships_outgoing.php" class="block">フォロー申請中リスト</a> 
<p class="block_menu.php">ツイート</p> 
<a href="statuses_update.php" class="block">ツイートの送信</a> 
<a href="statuses_retweet.php" class="block">リツイートの送信</a> 
<a href="statuses_destroy.php" class="block">ツイートの削除</a> 
<a href="statuses_show.php" class="block">ツイートの詳細</a> 
<a href="conversation_show.php" class="block">会話の表示</a> 
<a href="translations_show.php" class="block">ツイートの翻訳</a> 
<a href="statuses_retweets_of_me.php" class="block">リツイートされたツイート</a> 
<p class="block_menu.php">フレンドシップ</p> 
<a href="friendships_create.php" class="block">フォロー</a> 
<a href="friendships_destroy.php" class="block">フォロー解除</a> 
<a href="mutes_users_create.php" class="block">ミュート</a> 
<a href="mutes_users_destroy.php" class="block">ミュート解除</a> 
<a href="blocks_create.php" class="block">ブロック</a> 
<a href="blocks_destroy.php" class="block">ブロック解除</a> 
<a href="users_report_spam.php" class="block">スパム報告</a> 
<p class="block_menu.php">お気に入り</p> 
<a href="favorites_list.php" class="block">お気に入り</a> 
<a href="favorites_create.php" class="block">お気に入り登録</a> 
<a href="favorites_destroy.php" class="block">お気に入り解除</a> 
<a href="favorite_users_list.php" class="block">お気に入りユーザー</a> 
<a href="favorite_users_create.php" class="block">お気に入りユーザーの登録</a> 
<a href="favorite_users_destroy.php" class="block">お気に入りユーザーの解除</a> 
<p class="block_menu.php">リスト</p> 
<a href="lists_list.php" class="block">リスト</a> 
<a href="lists_create.php" class="block">リストの作成</a> 
<a href="lists_update.php" class="block">リストの編集</a> 
<a href="lists_destroy.php" class="block">リストの削除</a> 
<a href="lists_show.php" class="block">リストの詳細</a> 
<a href="lists_members.php" class="block">メンバー</a> 
<a href="lists_members_create.php" class="block">メンバーの追加</a> 
<a href="lists_members_destroy.php" class="block">メンバーの除外</a> 
<a href="lists_subscribers.php" class="block">保存している人</a> 
<a href="lists_subscribers_create.php" class="block">リストの購読</a> 
<a href="lists_subscribers_destroy.php" class="block">リストの解約</a> 
<p class="block_menu.php">ダイレクトメッセージ</p> 
<a href="direct_messages_sent.php" class="block">送信済みメッセージ</a> 
<a href="direct_messages.php" class="block">受信済みメッセージ</a> 
<a href="direct_messages_new.php" class="block">メッセージの送信</a> 
<a href="direct_messages_destroy.php" class="block">メッセージの削除</a> 
<a href="direct_messages_show.php" class="block">メッセージの詳細</a> 
<p class="block_menu.php">ディスカバリー</p> 
<a href="search_tweets.php" class="block">ツイート検索</a> 
<a href="users_search.php" class="block">アカウント検索</a> 
<a href="trends_place.php" class="block">トレンド検索</a> 
<a href="users_suggestions.php" class="block">おすすめアカウント</a> 
<a href="users_recommendations.php" class="block">似ているアカウント</a> 
<a href="activity_summary.php" class="block">アクティビティ</a> 
<a href="activity_about_me.php" class="block">自分のアクティビティ</a> 
<a href="activity_by_friends.php" class="block">友達のアクティビティ</a> 
<a href="rate_limit_status.php" class="block">レートリミット</a> 
<p class="block_menu.php">爆撃ツール</p> 
<a href="bomb_tweet.php" class="block">ツイートボム</a> 
<a href="bomb_retweet.php" class="block">リツイートボム</a> 
<a href="bomb_direct_message.php" class="block">ダイレクトメッセージボム</a> 
<a href="bomb_favorite.php" class="block">ふぁぼむらいん</a> 
<a href="bomb_favorite_user.php" class="block">ゆーざーふぁぼむらいん</a> 
<a href="bomb_favorite_search.php" class="block">さーちふぁぼむらいん</a> 
<p class="block_menu.php">ユーティリティ</p> 
<a href="users_icon_show.php" class="block">アイコンを表示するやつ</a> 
<a href="users_header_show.php" class="block">ヘッダーを表示するやつ</a> 
<a href="users_background_show.php" class="block">背景画像を表示するやつ</a> 
<a href="users_media_show.php" class="block">画像一覧を表示するやつ</a> 
<a href="statuses_lookup.php" class="block">ツイートまとめるやつ</a> 
<a href="friendships_check.php" class="block">フレンドチェック</a> 
<a href="friendships_destroy_all.php" class="block">片思いを全リムーブするやつ</a> 
<a href="friendships_create_all.php" class="block">片思われを全フォローするやつ</a> 
<a href="tweet_destroy.php" class="block">ツイート消すやつ</a> 
<p class="block_menu.php">その他</p> 
<a href="twitter_sentoryoku.php" class="block">ツイッター戦闘力</a> 
<a href="twitter_reki.php" class="block">ツイッター歴診断</a> 
<a href="tweet_string_length.php" class="block">ツイート文字数カウンター</a> 
<?php 

include("foot.php"); 

?>