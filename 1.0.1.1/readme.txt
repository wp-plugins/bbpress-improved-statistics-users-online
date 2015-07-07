=== bbPress Advanced Statistics ===
Contributors: GeekServe
Donate link: http://thegeek.info/donate
Tags: bbpress, statistics, users, online
Requires at least: 3.9
Tested up to: 4.2.1
Stable tag: 1.0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

bbPress doesn't provide very intuitive Statistics functionality, with this plugin we aimed on improving that.

== Description ==

With bbPress Advanced Statistics, webmasters will be able to easily plonk an awesome shortcode on their forum - and it will immediately come to life showing off the forum statistics. 

PLEASE NOTE: This plugin includes some code that enables shortcodes within 
sidebars, since this is not default functionality. Once we find a solution to
getting an official widget working, this code will be removed.

This plugin works using shortcodes only, currently there is no widget included.

== Installation ==

Installing "bbPress Advanced Statistics" can be done either by searching for "bbPress Advanced Statistics" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

Once you're ready, add the shortcode [bbpas-activity] anywhere on your site to
display the Statistics. We'd recommend adding it to a sidebar HTML field!

== Screenshots ==

1. The plugin in action, screen depicts the plugin in use on a website
2. Standard Options available within the WordPress Admin Page
3. Some customisation options, with more to come in pending updates

== Frequently Asked Questions ==

= Is bbPress a requirement for this plugin? =

Yes, absolutely. 

= Does this work for previously logged in users? =

Unfortunately, WordPress nor bbPress provide a "user is online" functionality out of the box - we had to add that ourselves, thus - data will only be displayed in this plugin after it has been installed as users log in to your site. 

= So, I've installed it... where's my stats? =

You will need to include the shortcode: [bbpas-activity] on your site. 

= Are there any settings I can change? =

Yeah, there is. Under the "Forums" menu item, you should see "Advanced Statistics"

= Do you have a widget? =

Unfortunately not, at the moment. We will need to do a fair bit of tinkering to get a widget working, so left it out of the
initial release - however, it is the most important feature on the list so keep an eye out for any updates

== Changelog ==

= 1.0.1.1 - 2015-05-12 =
 * Addition of shortcode activation with HTML widget
 * Fix dependency error for PHP, see: https://wordpress.org/support/topic/error-message-421
 * SVN clean up, moving screenshots to the assets folder

= 1.0.1 - 2015-05-11 =
* Fixed logic bug with users last online, it now correctly works out how many users were online in the past x hours

= 1.0 - 2015-05-10 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* 2015-05-10
* Initial release
