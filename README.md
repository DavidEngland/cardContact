# Card Footer Shortcode for Connections

A WordPress plugin that outputs address, phone, and email for a Connections Business Directory entry, styled for footer use. Provides a simple shortcode for use in theme footers, widgets, or anywhere shortcodes are supported.

## Features
- Outputs address (linked to Google Maps), phone (tel:), and email (mailto:) for a Connections entry
- All output is wrapped in a customizable class for easy CSS targeting
- Each line (address, phone, email) is in its own div for precise spacing and styling
- Safe output: all data is sanitized and escaped
- Designed for use in footers, but can be used anywhere

## Usage
Add the shortcode where you want the contact card to appear:

```
[cardfooter id="1" class="footer-contact-card" map_title="Get Directions"]
```

- `id` (required): Connections entry ID
- `class` (optional): CSS class for the wrapper div (default: `footer-contact-card`)
- `map_title` (optional): Title attribute for the map link (default: `Get Directions`)

## Example Output
```html
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

## Requirements
- WordPress
- [Connections Business Directory](https://connections-pro.com/) plugin

## Installation
1. Upload the plugin folder to `/wp-content/plugins/`.
2. Activate the plugin in the WordPress admin.
3. Use the `[cardfooter]` shortcode as described above.

## Customization
- Style the output using the `.footer-contact-card` class and its children in your theme's CSS.
- You can override the class name via the `class` attribute in the shortcode.

## License
GPLv2 or later. See LICENSE.txt for details.

## Author
David E. England, Ph.D.

---
For issues or feature requests, please open an issue on GitHub.
