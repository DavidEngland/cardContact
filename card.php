<?php
/*
Plugin Name: Card Footer Shortcode for Connections
Description: Outputs address, phone, and email for a Connections entry, styled for footer use.
Version: 1.1
Author: David E. England, Ph.D.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * [cardfooter] shortcode
 * Outputs address (linked to Google Maps), phone, and email for a Connections entry.
 * Usage: [cardfooter id="1" class="footer-contact-card" map_title="Get Directions"]
 * - id: Connections entry ID (required)
 * - class: CSS class for the wrapper div (optional, default: footer-contact-card)
 * - map_title: Title attribute for the map link (optional)
 */
add_shortcode( 'cardfooter', function ( $atts ) {
    // Ensure Connections plugin is active
    if ( ! function_exists( 'Connections_Directory' ) ) {
        return '<span>Connections plugin not active.</span>';
    }

    // Parse shortcode attributes
    $atts = shortcode_atts( array(
        'id'        => 1,
        'class'     => 'footer-contact-card',
        'map_title' => 'Get Directions',
    ), $atts, 'cardfooter' );

    $id        = intval( $atts['id'] );
    $class     = sanitize_html_class( $atts['class'] );
    $map_title = esc_attr( $atts['map_title'] );

    if ( ! $id ) return '<span>No entry ID specified.</span>';

    // Retrieve the Connections entry
    $args    = array( 'status' => 'approved', 'limit' => 1, 'id' => $id );
    $results = Connections_Directory()->retrieve->entries( $args );
    if ( empty( $results ) || ! class_exists( 'cnEntry' ) ) {
        return '<span>No entry found.</span>';
    }
    $entry = new cnEntry( $results[0] );

    // Address block
    $address     = '';
    $map_url     = '';
    $addresses   = $entry->getAddresses();
    if ( ! empty( $addresses ) && ! empty( $addresses[0]->line_1 ) ) {
        $address = esc_html( trim(
            $addresses[0]->line_1 . ', ' .
            $addresses[0]->city . ', ' .
            $addresses[0]->state . ' ' .
            $addresses[0]->zip_code
        ) );
        $map_query = urlencode( $addresses[0]->line_1 . ', ' . $addresses[0]->city . ', ' . $addresses[0]->state . ' ' . $addresses[0]->zip_code );
        $map_url   = 'https://maps.google.com/?q=' . $map_query;
    }

    // Phone block
    $phone        = '';
    $phone_display = '';
    $phones       = $entry->getPhoneNumbers();
    if ( ! empty( $phones ) && ! empty( $phones[0]->number ) ) {
        $phone_display = esc_html( $phones[0]->number );
        $phone         = preg_replace( '/[^0-9\+]/', '', $phones[0]->number );
    }

    // Email block
    $email  = '';
    $mailto = '';
    $emails = $entry->getEmailAddresses();
    if ( ! empty( $emails ) && ! empty( $emails[0]->address ) ) {
        $email = esc_html( $emails[0]->address );
        // For mailto, get raw
        $emails_raw = $entry->getEmailAddresses( array( 'raw' => TRUE ) );
        $mailto     = ( ! empty( $emails_raw ) && ! empty( $emails_raw[0]->address ) ) ? sanitize_email( $emails_raw[0]->address ) : '';
    }

    // Output HTML
    ob_start();
    ?>
    <div class="<?php echo $class; ?>" id="footer-contact-<?php echo $id; ?>">
        <?php if ( $address && $map_url ): ?>
            <div class="footer-contact-address">
                <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $map_title; ?>">
                    <?php echo $address; ?>
                </a>
            </div>
        <?php endif; ?>
        <?php if ( $phone ): ?>
            <div class="footer-contact-phone">
                <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo $phone_display; ?></a>
            </div>
        <?php endif; ?>
        <?php if ( $email && $mailto ): ?>
            <div class="footer-contact-email">
                <a href="mailto:<?php echo esc_attr( $mailto ); ?>"><?php echo $email; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
});

/*
Documentation:
- [cardfooter id="1"] outputs address (linked to Google Maps), phone, and email for Connections entry #1.
- All output is wrapped in a div with a customizable class for easy CSS targeting (e.g., for footer).
- Each line is in its own div for precise spacing control.
- Add custom CSS for `.footer-contact-card` and its children as needed.
*/
