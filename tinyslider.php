<?php
/**
 * Plugin Name:       TinySlider
 * Plugin URI:        https://example.com/plugins/tinyslider/
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


// CSS and JS
function tinys_assets(){
    wp_enqueue_style( 'tinyslider-css', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css", null, '1.0' );
    wp_enqueue_script( 'tinyslider-js', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", array('jquery'), time(), true );
    wp_enqueue_script( 'tinyslider-main-js', plugin_dir_url( __FILE__ ) . "/assets/js/tinyslider-main.js", array('jquery'), time(), true );
}
add_action( 'wp_enqueue_scripts', 'tinys_assets' );

function tinys_shortcode_tslider( $args, $content ) {
    $defaults = array(
        'width' => 800,
        'height' => 600,
        'id' => ''
    );
    $attributes = shortcode_atts( $defaults, $args );
    $content = do_shortcode( $content );

    $shortcode_output = '
        <div id="{$attributes[id]}" style="width:{$attributes[width]}; height={$attributes[height]}">
            <div class="slider">
                {$content}
            </div>
        </div>
    ';

    return $shortcode_output;
}
add_shortcode( 'tslider', 'tinys_shortcode_tslider' );

// 11.00 mins




