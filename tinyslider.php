<?php
/**
 * Plugin Name:       TinySlider
 * Plugin URI:        https://example.com/plugins/qrcode/
 * Description:       This is practise plugin.
 * Version:           1.0
 * Author:            Sohan
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       tinyslider
 * Domain Path:       /languages
 */

//Load Text Domain
function tinys_load_textdomain(){
    load_plugin_textdomain( 'tinyslider', 'false'. dirname(__FILE__)."/languages" );
}
add_action( 'plugin_loaded', 'tinys_load_textdomain' );

function tinys_shortcode_tslider( $args, $content ) {
    $defaults = array(
        'width' => 800,
        'height' => 600,
        'id' => ''
    );
    $attributes = shortcode_atts( $defaults, $args );
    $content = do_shortcode( $content );

    $shortcode_output = 'test output';

    return $shortcode_output;
}
add_shortcode( 'tslider', 'tinys_shortcode_tslider' );