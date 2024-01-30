<?php
/**
 * Following WP tutorial here: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest, * or null if none.
 */
    function the_callback_func( $data ) {
        $posts = get_posts( array(
            'author' => $data['id'],
        ) );
        if ( empty( $posts ) ) {
            return null;
        }
        return $posts[0]->post_title;        
    }

    function dummy_res($data){
        echo "Hello! I'm a dummy method to test if an endpoint is registered"."\r\n"."Endpoint:".get_rest_url();
        return;
    }

    function print_param($data){
        $param = $data->get_param( 'param' );
        return "Hello! Print_param = ".$param;
    }

    // Registering rest routes
    add_action('rest_api_init', function () {

        register_rest_route( 'route_namespace/version_1', '/route/(?P<id>\d+)', array(
            'methods' => 'GET',
            'callback' => 'the_callback_func',
        ));

    } );
    //http://localhost/wordpress/wp-json/route_namespace/version_1/route/1

    
    add_action('rest_api_init', function () {

        register_rest_route( 'route_namespace/version_1', '/route', array(
            'methods' => 'GET',
            'callback' => 'print_easy',
        ));

    } );
    //http://localhost/wordpress/wp-json/route_namespace/version_1/route/

    add_action('rest_api_init', function () {

        register_rest_route( 'route_namespace/version_1', '/route/query_string', array(
            'methods' => 'GET',
            'callback' => 'print_param',
        ));

    } );

    /**
     * CRUD endpoints & callbacks
     * 
     */

     //Create
     function create_note($data){
        $sql = "INSERT INTO wp_hello_world VALUES value1 value2 value3";
        //mysql qp-post stuff codem ipuso color sin amet
     }
     add_action('rest_api_init', function () {

        register_rest_route( 'hello-world/v1', '/notes', array(
            'methods' => 'GET',
            'callback' => 'dummy_res',
        ));

    } );
     //Read
     function get_all_notes(){
        // return all posts (make your own post type)
     }
     function get_note($data){
        $url_id = $data->get_param("id");
        //return note id
     }
     //Update
     function update_post($data){
        //$sql = "UPDATE todo SET description = $1 WHERE todo_id = $2", [description, id];
        //mysql qp-post stuff codem ipuso color sin amet
     }
     //Delete
     function delete_note($data){
        $url_id = $data->get_param("id");
     }

?>