=== Card Footer Shortcode for Connections ===
Contributors: davidengland
Tags: connections, directory, contact, address, phone, email, shortcode, footer
Requires at least: 5.6
Tested up to: 6.5
Requires PHP: 7.0
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple shortcode to output address, phone, and email for a Connections Business Directory entry, styled for footer or widget use.

== Description ==
This plugin provides a shortcode `[cardfooter]` that outputs the address (linked to Google Maps), phone (tel:), and email (mailto:) for a Connections Business Directory entry. Each item is wrapped in its own div for easy styling, and the output is safe and sanitized. Designed for use in footers, widgets, or anywhere shortcodes are supported.

== Installation ==
1. Upload the plugin folder to `/wp-content/plugins/`.
2. Activate the plugin through the WordPress admin.
3. Use the `[cardfooter]` shortcode as described below.

== Usage ==
Add the shortcode where you want the contact card to appear:

`[cardfooter id="1" class="footer-contact-card" map_title="Get Directions"]`

* `id` (required): Connections entry ID
* `class` (optional): CSS class for the wrapper div (default: `footer-contact-card`)
* `map_title` (optional): Title attribute for the map link (default: `Get Directions`)

== Example Output ==
```
<div class="footer-contact-card" id="footer-contact-1">
  <div class="footer-contact-address">
    <a href="https://maps.google.com/?q=123+Main+St,+City,+ST+12345" target="_blank" rel="noopener noreferrer" title="Get Directions">123 Main St, City, ST 12345</a>
  </div>
  <div class="footer-contact-phone">
    <a href="tel:+1234567890">(123) 456-7890</a>
  </div>
  <div class="footer-contact-email">
    <a href="mailto:info@example.com">info@example.com</a>
  </div>
</div>
```

== Frequently Asked Questions ==

= Does this require the Connections Business Directory plugin? =
Yes. This plugin is an add-on for Connections and will not work without it.

= Can I style the output? =
Yes! Use the `class` attribute or target `.footer-contact-card` and its children in your theme's CSS.

= What if the entry has no address, phone, or email? =
That line will simply not be shown.

== Changelog ==
= 1.1 =
* Initial public release.

== Upgrade Notice ==
= 1.1 =
First public release. Requires Connections Business Directory plugin.

== License ==
GPLv2 or later. See LICENSE.txt for details.
