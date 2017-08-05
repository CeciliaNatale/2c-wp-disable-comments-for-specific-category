<?php
/**
 * Plugin Name: 2c WP Disable comment for specific category
 * Plugin URI: http://www.cecilianatale.it
 * Description: Disable comments for specific category
 * Author: Cecilia Natale
 * Author URI: http://www.cecilianatale.it
 * Version: 0.1.0
 */

add_action( 'the_post', '__2c_wp_check_for_closed' );

/**
 * check for category to disable comments
 * @var [type]
 */
function __2c_wp_check_for_closed(){
     global $post;

     $my_post_cat = wp_get_post_categories($post->ID);

     $disabled_cat = array( "30", "6", "3"); // this is he array of disabled categories. Feel free to edit this line as per your needs.

     $my_result = array_intersect($my_post_cat,$disabled_cat);

         if (empty ( $my_result ) )
             return;
          else {
            add_filter( 'comments_open', '__2c_wp_close_comments_on_category', 10, 2 );
            add_action('wp_enqueue_scripts', '__2c_wp_deregister_reply_js');
          }
}
/**
 * deregister script
 * @var [type]
 */
function __2c_wp_deregister_reply_js(){
  wp_deregister_script( 'comment-reply' );
}

/**
 * close comment on category
 * @var [type]
 */
function __2c_wp_close_comments_on_category ($open, $post_id){
  $open = false;
}

?>
