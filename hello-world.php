<?php
/**
 * Plugin Name:       Hello World
 * Description:       They not making hello world tutorials no more, so I'm making my own.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Mahassin Poree-El
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hello-world
 */



// Our Constants
define( 'HLWD_VERSION', '1.0' );
define( 'HLWD__MINIMUM_WP_VERSION', '5.8' );
define( 'HLWD__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
// define( 'HLWD_DELETE_LIMIT', 10000 );

/**
 * function my_page()
 * Creates a Hello World! page.
 * @param none
 * @return void
 */
function my_page(){
    $postarr = array(
        'post_title'    => 'Hello World!',
        'post_content'  => '<p>Hello World!</p>',
        'post_type'     => 'page', //post_type subject to change lol, i have free will
        'post_name'     => 'hello-world',
    );
    $post_id = wp_insert_post($postarr);
}


/**
 * function plugin_activation()
 * Runs my_page() when the plugin is activated, only if no drafted & no published Hello World pages
 * @param none
 * @return void
 */
function plugin_activation(){
    if(!post_exists('Hello World!','','','','publish') || !post_exists('Hello World!','','','','draft') ){ my_page();}
}

/**
 * function plugin_deactivation()
 * Supposed to echo Goodbye World! but the page refreshes so ¯\_( ツ )_/¯
 * @param none
 * @return void
 */
function plugin_deactivation(){
    echo 'Goodbye World!';
}

register_activation_hook( __FILE__, 'plugin_activation' );
register_deactivation_hook( __FILE__, 'plugin_deactivation' );

// add_action( 'init', array( 'Hello_World', 'init' ) );

/**
 * Require endpoints
 */

 require_once plugin_dir_path( __FILE__ ) . "rest/endpoints.php";


 

/**
 * This is our callback function that embeds our phrase in a WP_REST_Response
 */
function hello_world_get_endpoint_base() {
    // rest_ensure_response() wraps the data we want to return into a WP_REST_Response, and ensures it will be properly returned.
    return rest_ensure_response( 'Hello World, this is the WordPress REST API for my react plugin' );
  }
  
  /**
  * This function is where we register our routes for our example endpoint.
  */
  function hello_world_register_example_routes() {
    // register_rest_route() handles more arguments but we are going to stick to the basics for now.
    register_rest_route( 'hello-world/v1', '/base', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::READABLE,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'hello_world_get_endpoint_base',
    ) );
    // http://localhost/wordpress/wp-json/hello-world/v1/base
  }
  
  add_action( 'rest_api_init', 'hello_world_register_example_routes' );