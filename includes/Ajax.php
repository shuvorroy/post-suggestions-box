<?php

namespace My_Plugin;

/**
 * Ajax Class
 */
class Ajax {

  /**
   * Initialize the class
   */
  function __construct() {
    add_action( 'wp_ajax_get_related_posts', [ $this , 'get_related_posts' ] );
    add_action( 'wp_ajax_nopriv_get_related_posts', [ $this , 'get_related_posts'] );
  }

  /**
   * Get related posts
   * @return void
   */
  public function get_related_posts() {
    $post_id = $_POST['post_id'];
    $response = [];
    $related_query = new \WP_Query(array(
      'post_type' => 'post',
      'category__in' => wp_get_post_categories( $post_id ),
      'post__not_in' => [$post_id],
      'posts_per_page' => 10,
      'orderby' => 'date',
      'order' => 'DESC'
    ));

    $allposts = $related_query->posts;

    if ( count( $allposts ) ) {
      $response['count'] = count( $allposts );

      $top_post = $allposts[0];
      unset( $allposts[0] );
      $response['releted_posts_top'][0] = [
        'image_url' => get_the_post_thumbnail_url( $top_post->ID, 'full' ),
        'author' => get_the_author_meta( 'first_name', $top_post->post_author ).' '.get_the_author_meta( 'last_name', $top_post->post_author ),
        'title' => $top_post->post_title,
        'updated' => get_the_modified_date( 'F j, Y', $top_post->ID ) ? : '',
        'created' => get_the_date( 'F j, Y', $top_post->ID ) ? : '',
        'date' => get_the_modified_date( 'F j, Y', $top_post->ID ) == get_the_date( 'F j, Y', $top_post->ID ) ? get_the_date( 'F j, Y', $top_post->ID ) : "Updated ".get_the_modified_date( 'F j, Y', $top_post->ID ),
        'link' => get_the_permalink( $top_post->ID )
      ];
      if ( get_time_diff_in_hours( $top_post->ID ) <= 96 ) {
        $response['releted_posts_top'][0]['published'] = sprintf( "NEW - %s ago", human_time_diff( get_the_time('U', $top_post->ID ), current_time('timestamp') ) );
      }

      foreach ( $allposts as $key => $pst ) {
        $response['releted_posts'][$key] = [
          'image_url' => get_the_post_thumbnail_url( $pst->ID, 'full' ),
          'author' => get_the_author_meta( 'first_name', $pst->post_author ).' '.get_the_author_meta( 'last_name', $pst->post_author ),
          'title' => $pst->post_title,
          'updated' => get_the_modified_date( 'F j, Y', $pst->ID ) ? : '',
          'created' => get_the_date( 'F j, Y', $pst->ID ) ? : '',
          'date' => get_the_modified_date( 'F j, Y', $pst->ID ) == get_the_date( 'F j, Y', $pst->ID ) ? get_the_date( 'F j, Y', $pst->ID ) : "Updated ".get_the_modified_date( 'F j, Y', $pst->ID ),
          'link' => get_the_permalink( $pst->ID )
        ];
        if ( get_time_diff_in_hours( $pst->ID ) <= 96 ) {
          $response['releted_posts'][$key]['published'] = sprintf( "NEW - %s ago", human_time_diff( get_the_time('U', $pst->ID ), current_time('timestamp') ) );
        }
      }
    }
    wp_send_json( $response );
  }
}
