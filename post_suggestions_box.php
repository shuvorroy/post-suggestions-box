<?php
/**
* Plugin Name: Post Suggestions Box
* Plugin URI: http://localhost/srapps
* Description: Display related post suggestions inside Post Content.
* Version: 1.0.0
* Author: Shuvo Roy
* Author URI: http://localhost/srapps
* Text Domain: post-suggestions-box
* Domain Path: /languages
* License: GPL2
*/


if ( ! defined( 'ABSPATH' ) ) {
  exit();
}

require_once __DIR__ . '/vendor/autoload.php';


final class My_Plugin {
  /**
   * Plugin Version
   */
  const VERSION = '1.0.0';

  /**
   * Plugin Version
   */
  private static $instance = null;

  /**
   * Construct
   */
  public function __construct() {
    $this->define_constants();
    register_activation_hook( __FILE__, [ $this, 'activate' ] );
    register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );
    add_action( 'plugins_loaded', [ $this, 'init_plugin_classes' ] );
  }

  /**
   * Singletone Instance
   */
  public static function init() {
    if ( self::$instance === null ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
  * Activate
  */
  public function activate() {
    //Executed on plugin activation
  }

  /**
  * Deactivate
  */
  public function deactivate() {
    //Executed on plugin de-activation
  }

  /**
   * Define all constants
   */
  public function define_constants() {
    define( 'MYPLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'MYPLUGIN_URL', trailingslashit( plugin_dir_URL( __FILE__ ) ) );
    define( 'MYPLUGIN_ASSETS', trailingslashit( MYPLUGIN_URL . 'assets' ) );
  }

  /**
   * Init plugin classes
   */
  public function init_plugin_classes() {
    new My_Plugin\Assets();
    new My_Plugin\Ajax();
    if ( is_admin() ) {
      //Load admin classes if needed
    } else {
      new My_Plugin\Frontend();
    }
  }
}

function init_my_plugin() {
  return My_Plugin::init();
}

$my_plugin = init_my_plugin();
