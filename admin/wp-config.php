<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', '_pp_sample');

/** MySQL データベースのユーザー名 */
define('DB_USER', '_pp_sample');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'gim3ag85nga');

/** MySQL のホスト名 */
define('DB_HOST', 'mysql516.heteml.jp');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'O9Hq6k!bwxQ1PN9&tm9yVZ=gb8``%ffTe)~bsB]f>nWi@Vn$}n2yD,U8+u^:Q3h;');
define('SECURE_AUTH_KEY',  '9!qsC$OVq%_!a!&3p8r.*C->=ECh|$w}%d-HgZ6Nd@P_]V=!T9:cC`uTe<@6@)__');
define('LOGGED_IN_KEY',    'kFfH8czcwF0+4*-O*`,KV57@.><C`Kb9u|It3|LqhCzbL9,T{[8w<5(}/^eJi{JS');
define('NONCE_KEY',        'XvBR/r|u:<Ma=W:Or.A8)H{[e5eC[*yt4@A)#b2<sEq954Om)sk:?!Gx6&@>/*!)');
define('AUTH_SALT',        '~B;B7)SqM}qH^_:A(yP{00:x5E&+N)=qJC.GKe<077|[[LV}A&Y[6m*1,/!Y[?Ee');
define('SECURE_AUTH_SALT', 'VQ&9;]1.??DKe3m99B@5*}x?Myrh)<CdgHewdV8woB|J`%J_Fe?N6)hJ6O-$eNhB');
define('LOGGED_IN_SALT',   'yB=R1<EfSf+rkS&+<`X/D`W~niDI;%n%G5W|-47da(KAYQKpq#2/|PN&=uNDy@I`');
define('NONCE_SALT',       ';8X|3U4TbFy@z~9gC1udH|jZ-<79HF`XDwy{Gsu#=j])$[nF/X#Vzl:92-9~Q`0y');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

add_filter('xmlrpc_enabled', '__return_false');

add_filter('xmlrpc_methods', function($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    return $methods;
});