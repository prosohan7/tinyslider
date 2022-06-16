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
add_action( 'plugins_loaded', 'tinys_load_textdomain' );

// Crop image size
function tinys_init(){
    add_image_size( 'tiny-slider', 800, 600, true );
}
add_action( 'init', 'tinys_init' );

// CSS and JS
function tinys_assets(){
    wp_enqueue_style( 'tinyslider-css', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css", null, '1.0' );
    wp_enqueue_script( 'tinyslider-js', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", array('jquery'), time(), true );
    wp_enqueue_script( 'tinyslider-main-js', plugin_dir_url( __FILE__ ) . "/assets/js/tinyslider-main.js", array('jquery'), time(), true );
}
add_action( 'wp_enqueue_scripts', 'tinys_assets' );

// Tslider Shortcode
function tinys_shortcode_tslider( $args, $content ) {
    $defaults = array(
        'width' => 800,
        'height' => 600,
        'id' => ''
    );
    $attributes = shortcode_atts( $defaults, $args );
    $content = do_shortcode( $content );
    $shortcode_output = <<<EOD
        <div id="{$attributes['id']}" style="width:{$attributes['width']}; height={$attributes['height']}">
            <div class="slider">
                {$content}
            </div>
        </div>
    EOD;

    return $shortcode_output;
}
add_shortcode( 'tslider', 'tinys_shortcode_tslider' );

function tinys_shortcode_tslide( $args ){
    $defaults = array(
        'caption' => '',
        'id' => '',
        'size' => 'tiny-slider' 
    );
    $attributes = shortcode_atts( $defaults, $args );
    $image_src = wp_get_attachment_image_src( $attributes['id'], $attributes['size'] );
    $shortcode_output = <<<EOD
        <div class="slide">
            <p><img src="{$image_src[0]}" alt="{$attributes['caption']}"></p>
            <p>{$attributes['caption']}</p>
        </div>
    EOD;

    return $shortcode_output;
}
add_shortcode( 'tslide', 'tinys_shortcode_tslide' );
// 11.00 mins




