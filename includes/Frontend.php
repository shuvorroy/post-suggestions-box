<?php
namespace My_Plugin;


/**
 * Frontend Class
 */
class Frontend {


  public function __construct() {
    add_filter( 'the_content', [ $this, 'insert_shortcode' ] );
    add_shortcode( 'related_post_suggestion', [ $this, 'related_post_suggestion_html' ] );
  }

  /**
   * Insert shortcode to Post content
   *
   * @param String $content
   *
   * @return String
   */
  public function insert_shortcode( $content ) {

    $shortcode = "[related_post_suggestion]";

    if ( is_singular( 'post' ) ) {
      $count = substr_count( $content, '</p>' );
      if ( $count >= 7 ) { //check if number of paragraphs more than or equal 7
        $paragraphs = explode( '</p>', $content );
        foreach ( $paragraphs as $index => $paragraph ) {
          if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= '</p>';
          }
          if ( $index == 2 ) {
            $paragraphs[$index] .= $shortcode;
          }
        }
        $content = implode( '', $paragraphs );
      } else {
        $content .= $shortcode;
      }
    }
    return $content;
  }

  /**
   * Shortcode html
   *
   * @return String
   */
  public function related_post_suggestion_html() {
    global $post;
    ob_start();
    include_once __DIR__ . '/views/related_post_suggestion_html.php';
    return ob_get_clean();
  }
}
