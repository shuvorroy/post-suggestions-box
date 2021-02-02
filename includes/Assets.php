<?php
namespace My_Plugin;


/**
 * Assets Class
 */
class Assets {

  /**
   * Initialize the class
   */
  public function __construct() {
    add_action( 'init', [ $this, 'register_all_scripts' ], 10 );
    if ( !is_admin() ) {
      add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front_scripts' ] );
    }
  }

  /**
   * Register all scripts
   */
  public function register_all_scripts() {
    $this->register_styles();
    $this->register_scripts();
  }

  /**
   * Register style
   */
  public function register_styles() {
    $styles = [
      'myplugin-style' => [
        'src' => MYPLUGIN_ASSETS . 'css/style.css',
        'deps' => [],
        'version' => rand()
      ]
    ];

    foreach ( $styles as $handle => $style ) {
      $src = $style['src'];
      $deps = $style['deps'];
      $version = $style['version'];
      wp_register_style( $handle, $src, $deps, $version );
    }
  }

  /**
   * Register scrpts
   */
  public function register_scripts() {
    $scripts = [
      'myplugin-script' => [
        'src' => MYPLUGIN_ASSETS . 'js/script.js',
        'deps' => [ 'jquery', 'wp-util' ],
        'version' => rand(),
        'in_footer' => true
      ]
    ];

    foreach ( $scripts as $handle => $script ) {
      $src = $script['src'];
      $deps = $script['deps'];
      $version = $script['version'];
      $in_footer = $script['in_footer'];
      wp_register_script( $handle, $src, $deps, $version, $in_footer );
    }
  }


  /**
   * Enqueue frondend related scrips and styles
   */
  public function enqueue_front_scripts() {
    wp_enqueue_style( 'myplugin-style' );
    wp_enqueue_script( 'myplugin-script' );
    wp_localize_script( 'myplugin-script', 'mp_var', [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		] );
  }
}
