=== bbPress Advanced Statistics ===
Contributors: GeekServe
Donate link: http://thegeek.info
Tags: bbpress, statistics, users, online
Requires at least: 3.9
Tested up to: 4.2.2
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The statistical functionality within core bbPress is limited, with this plugin, you can achieve phpBB / vBulletin-esque statistics for bbPress

== Description ==

** We're currently having issues with the SVN repository. Version 1.1.1 is the most current and up-to-date version. **

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
sidebars, since this is not default functionality. 

**Rate us & Submit your website using our plugin!**

Create an honest review for our plugin and link your website, we will be selecting our favourites
in the coming weeks for our official plugin website!

Thank you for the support!

== Installation ==

Installing "bbPress Advanced Statistics" can be done either by searching for "bbPress Advanced Statistics" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

From there, you should now have an option under "Forums" called "Advanced Statistics". Here, you can set various important parts of the plugin, such as the locations where the statistics are displayed.

Alternatively, you can use the shortcode we have added, [bbpas-activity] anywhere on your site to
display the Statistics. We'd recommend adding it to a sidebar HTML field!

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

You can use the shortcode, [bbpas-activity], within a text widget (for example, if you wanted to display your stats on your blog too)

= Are there any settings I can change? =

Yeah, there is. Under the "Forums" menu item, you should see "Advanced Statistics"

= Do you have a widget? =

We have since added support for the plugin to be activated via both a shortcode and via the use of already-existing hooks. Both of these achieve what a Widget is capable of.

We no longer have any plans to develop a widget.

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

Once you are happy with your Translation, drop it into /wp-content/languages/bbpress-advanced-statistics/ and send it to us via email: jake@thegeek.info, so we can add it into the official plugin for future releases.

**Again, we must stress the file has to be identical to that WordPress expects, else your language pack will not be used!**

== Changelog ==

= 1.1.1 - 12th July, 2015 =
 * Feature: Threads and Posts can now be combined, bbPress Statistics do not count the first post of a thread as a post, this can be toggled within the settings.
 * Improve: Language packs can be overrided now, any packs loaded in /wp-content/languages/bbpress-advanced-statistics/ will override those packaged as part of the plugin
 * Improve: Translation String added for username hover over, "ago"
 * Improve: Minor code clean up & bug fixes
 * Bug Fix: Removal of duplicate "bbPress Statistics" option

= 1.1 - 4th July, 2015 =
 * Feature: WordPress "textdomain" language files are now supported, new translations can be added into the /lang/ folder!
 * Feature: Hover text added to users within the Forum Statistics section
 * Improve: Added additional localisation strings

= 1.0.3 - 25th May, 2015 =
 * Feature: Count parameters: %COUNT_ACTIVE_USERS% and %COUNT_ALL_USERS% to display count of users active recently & inactive
 * Feature: Minutes parameter: %MINS% to display the option "User Active Time" value
 * Improve: No longer grabbing unnecessary data from the database
 * Improve: Removed unused code and variables, fixed up some incorrect code comments
 * Bug Fix: Time logic within the Currently Active Users portion fixed, now correctly displays the currently active users regardless of what option is set
 * Bug Fix: User Active Time option not working - incorrect variable used within the options page, options will require a resave
 * Bug Fix: Default options are now saved when the user first installs the plugin

= 1.0.2.1 - 23rd May, 2015 =
 * Bug Fix: PHP error when installing v1.0.2 (sorry about that)
 * Bug Fix: No longer time-travelling the release!

= 1.0.2.1 - 22nd May, 2015 =
 * Feature: New options added to display the statistics within bbPress without widgets, see: https://wordpress.org/support/topic/in-forum-display
 * Improve: Updated the way options are saved in the Database and removed some redundant code
 * Bug Fix: Fixed "an error has occurred" message when no users were online / active within the past 24 hours
 * Bug Fix: Fixed a PHP warning when no options were set for checkboxes

= 1.0.1.1 - 12th May, 2015 =
 * Feature: Addition of shortcode activation with HTML widget
 * Improve: SVN clean up, moving screenshots to the assets folder
 * Bug Fix: Dependency error for PHP, see: https://wordpress.org/support/topic/error-message-421

= 1.0.1 - 11th May, 2015 =
 * Bug Fix: Logic bug with users last online, it now correctly works out how many users were online in the past x hours

= 1.0 - 10th May, 2015 =
* Initial release

== Upgrade Notice ==

= 1.1.1 =
* Few new features
* Additional localisation support

= 1.1 =
* Full localisation support
* Bug fixes

= 1.0.3 =
* 2015-05-25
* Fixes various bugs, please deactivate & reactivate after upgrade!

= 1.0 =
* 2015-05-10
* Initial release
