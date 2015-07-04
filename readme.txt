=== bbPress Advanced Statistics ===
Contributors: GeekServe
Donate link: http://thegeek.info
Tags: bbpress, statistics, users, online
Requires at least: 3.9
Tested up to: 4.2.2
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The statistical functionality within core bbPress is limited, with this plugin, you can achieve phpBB / vBulletin-esque statistics for bbPress

== Description ==

The statistical functionality within core bbPress is limited, with this plugin, you can achieve phpBB / vBulletin-esque statistics for your bbPress Forum, 
you can opt to use the shortcode provided with the plugin, or, you can use the options provided within the customisation tab of the plugin.

= What does this plugin provide? =

 * Currently Active Users
 * Users active within a set period of time
 * Listed users, with links to their profile pages
 * Customisable text strings, to suit your needs
 * WordPress domaintext ready! (Translations, see FAQ for further details)

**Please Note before installing**

This plugin includes some code that enables shortcodes within 
sidebars, since this is not default functionality. Once we find a solution to
getting an official widget working, this code will be removed.

== Installation ==

Installing "bbPress Advanced Statistics" can be done either by searching for "bbPress Advanced Statistics" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

Once you're ready, add the shortcode [bbpas-activity] anywhere on your site to
display the Statistics. We'd recommend adding it to a sidebar HTML field!

You cam also enable different locations for the plugin to appear within the customisation tab

== Screenshots ==

1. The plugin in action, screen depicts the plugin in use on a website
2. Standard Options available within the WordPress Admin Page
3. Some customisation options, with more to come in pending updates

== Frequently Asked Questions ==

= I need help, please help! =

We provide help in our designated WordPress Plugin forum, if you're stuck and need a hand with anything to do with the plugin, please post in [our official forum](https://wordpress.org/support/plugin/bbpress-improved-statistics-users-online).

Please provide as much information as possible when posting, including a link to your forum

= Is bbPress a requirement for this plugin? =

Yes, absolutely. Upon installation, if bbPress is not installed the install of this plugin will fail.

= Does this work for previously logged in users? =

Unfortunately, WordPress nor bbPress provide a "user is online" functionality out of the box - we had to add that ourselves, thus - data will only be displayed in this plugin after it has been installed as users log in to your site. 

= So, I've installed it... where are the stats? =

You can either enable the option within the setup menu, which will allow you to choose where the statistics are displayed on your forum

or

You can use the shortcode, [bbpas-activity], within a text widget.

= Are there any settings I can change? =

Yeah, there is. Under the "Forums" menu item, you should see "Advanced Statistics"

= Do you have a widget? =

Unfortunately not, at the moment. We will need to do a fair bit of tinkering to get a widget working, so left it out of the
initial release - however, it is the most important feature on the list so keep an eye out for any updates

= How do I create / submit a Translation? =

Translations are something we rely on users to create and submit, we have made it
super easy to create translations for this plugin, you simply need to grab the original
POT file (found within the plugin directory) and create translation files based off of that.

You can use [Poedit](http://https://poedit.net/) to create your translation.

 * [WPLang Tutorial](http://wplang.org/translate-theme-plugin/)
 * [ZaneMatthew](http://zanematthew.com/translate-a-wordpress-plugin-using-poedit/)
 
**Please Note:** The filename **must be** correct in order for your Translation to work. The naming convention is as follows:

 * bbpress-advanced-statistics-LOCALE.mo
 * bbpress-advanced-statistics-LOCALE.po

Where LOCALE is the code for your language, e.g German would be bbpress-advanced-statistics-de_DE.mo

You can find the correct code for your locale [here](https://make.wordpress.org/polyglots/teams/) 

Once you are happy with your Translation, drop it into /bbpress-improved-statistics-online/includes/lang/ and send it to us via email: support@thegeek.info, so we can add it into the official plugin
for future releases.

== Changelog ==

= 1.1 - 4th July, 2015 =
 * WordPress "textdomain" language files are now supported, new translations can be added into the /lang/ folder!
 * Hover text added to users within the Forum Statistics section
 * Added additional localisation strings

= 1.0.3 - 25th May, 2015 =
 * Feature: Count parameters: %COUNT_ACTIVE_USERS% and %COUNT_ALL_USERS% to display count of users active recently & inactive
 * Feature: Minutes parameter: %MINS% to display the option "User Active Time" value
 * Improve: No longer grabbing unnecessary data from the database
 * Improve: Removed unused code and variables, fixed up some incorrect code comments
 * Bug Fix: Time logic within the Currently Active Users portion fixed, now correctly displays the currently active users regardless of what option is set
 * Bug Fix: User Active Time option not working - incorrect variable used within the options page, options will require a resave
 * Bug Fix: Default options are now saved when the user first installs the plugin

= 1.0.2.1 - 23rd May, 2015 =
 * Fix for PHP error when installing v1.0.2 (sorry about that)
 * No longer time-travelling the release!

= 1.0.2.1 - 22nd May, 2015 =
 * New options added to display the statistics within bbPress without widgets, see: https://wordpress.org/support/topic/in-forum-display
 * Fixed "an error has occurred" message when no users were online / active within the past 24 hours
 * Updated the way options are saved in the Database and removed some redundant code
 * Fixed a PHP warning when no options were set for checkboxes

= 1.0.1.1 - 12th May, 2015 =
 * Addition of shortcode activation with HTML widget
 * Fix dependency error for PHP, see: https://wordpress.org/support/topic/error-message-421
 * SVN clean up, moving screenshots to the assets folder

= 1.0.1 - 11th May, 2015 =
* Fixed logic bug with users last online, it now correctly works out how many users were online in the past x hours

= 1.0 - 10th May, 2015 =
* Initial release

== Upgrade Notice ==

= 1.1 =
* Full localisation support
* Bug fixes

= 1.0.3 =
* 2015-05-25
* Fixes various bugs, please deactivate & reactivate after upgrade!

= 1.0 =
* 2015-05-10
* Initial release
