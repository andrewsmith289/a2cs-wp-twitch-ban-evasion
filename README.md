# a2cs-wp-twitch-ban-evasion

=== A2CS Twitch Ban Evasion ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: /
Tags: media, video, twitch, embed
Requires at least: 4
Tested up to: 5.4
Stable tag: 4.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The WordPress Plugin component of the A2CS Twitch Ban Evasion system. Provides a shortcode that embeds the current live
twitch stream in place.

== Description ==

The WordPress Plugin component of the A2CS Twitch Ban Evasion system. Provides a shortcode that embeds the current live
twitch stream in place.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `a2cs-twitch-ban-evasion.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Include the shortcode `[twitch_evasion_embed]` wherever the currently active stream will be displayed.

== Frequently Asked Questions ==

= Can I embed streams from other platforms? =

No. This plugin embeds Twitch stream iframes only.

== Screenshots ==

1. The plugin options interface.
2. The generated embed.

== Changelog ==

== Upgrade Notice ==

== Troubleshooting ==

Depending on the issue, please try the following steps:

**Error retrieving active stream pool account name. Check php logs for more information.**
There was an issue connecting to the account pool. The pool may not be running, or incorrect settings were entered in the plugin settings. Check the php error log for more information.
