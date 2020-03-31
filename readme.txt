=== Event Tickets Extension: Shortcodes ===
Contributors: ModernTribe
Donate link: http://m.tri.be/29
Tags: events, calendar
Requires at least: 4.5
Tested up to: 5.3.2
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPL version 3 or any later version
License URI: https://www.gnu.org/licenses/gpl-3.0.html

[Extension Description]

== Description ==

This extension allows you to have shortcodes for Event Tickets.

== Installation ==

Install and activate like any other plugin!

* You can upload the plugin zip file via the *Plugins ‣ Add New* screen
* You can unzip the plugin and then upload to your plugin directory (typically _wp-content/plugins_) via FTP
* Once it has been installed or uploaded, simply visit the main plugin list and activate it

== Frequently Asked Questions ==

= Where can I find more extensions? =

Please visit our [extension library](https://theeventscalendar.com/extensions/) to learn about our complete range of extensions for The Events Calendar and its associated plugins.

= What if I experience problems? =

We're always interested in your feedback and our [Help Desk](https://support.theeventscalendar.com/) are the best place to flag any issues. Do note, however, that the degree of support we provide for extensions like this one tends to be very limited.

== Changelog ==

= [1.1.0] 2020-03-31 =

* Add support for ticket protected content that excludes certain tickets using the new `not_ticket_ids` argument like: `[tribe_tickets_protected_content post_id="123" not_ticket_ids="32,50,90"]`
* Add support for RSVP protected content that excludes certain RSVPs using the new `not_rsvp_ids` argument like: `[tribe_tickets_rsvp_protected_content post_id="123" not_rsvp_ids="32,50,90"]`
* Add support for protected content shortcodes to show on a specific date, options available are `event_start_date` and date/time formats like `2020-05-01 08:00:00` using the new `on` argument like: `[tribe_tickets_rsvp_protected_content post_id="123" on="event_start_date"]`

= [1.0.0] 2020-03-26 =

* Initial release
