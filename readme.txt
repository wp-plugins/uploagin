=== Uploag-in ===
Contributors: sujin2f
Donate link: http://www.sujinc.com/lab/uploag-in/
Tags: login, security
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

"Uploag-in" will make a file input at your login page. You can upload the key file to login. It makes your login security more powerful.

== Description ==

"Uploag-in" will make a file input at your login page. You can upload the key file to login. It makes your login security more powerful.

로그인 페이지에 키 파일을 업로드하는 방식으로 로그인 보안을 높이는 플러그인입니다.

== Installation ==

= Installation =
1. Download the plugin zip package and extract it (플러그인을 다운로드하여 압축을 해제해주세요)
1. Put the folder named "uplogin" under /wp-content/plugins/ directory (플러그인 디렉토리에 넣어주세요)
1. Go to the plugins page in your Wordpress admin panel and click "Activate" (플러그인 관리 페이지에서 활성화 시키세요)

= Global Setting =
1. Go to the setting page (Settings > Uploagin) and choose option.
1. Go to Your Profile menu, and create the key file (png format)
1. You will check the file input at your login page

== Frequently Asked Questions ==

= If you lost your key =

If that user is not an administrator, login with administrator account and go to User. See that users profile and generate new key or delete key.

If user is administrator, connect your mySQL and delete row named sj-uploagin-key of user_id is 1. (delete from wp_usermeta where user_id=”1″ and meta_key=”sj-uploagin-key”)

= I cannot login via iPhone. =

It is impossible to login via iPhone. I will fix that problem in next version.

== Changelog ==

= 1.0 =
* Original Version