<?php

/**
 * Get time differance in hour
 *
 * @param Integer $post_id
 *
 * @return Float
 */
function get_time_diff_in_hours( $post_id ) {
  return abs( current_time( 'timestamp' ) - get_the_time( 'U', $post_id ) ) / 3600;
}
