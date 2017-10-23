<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:03
 */

namespace MKB\Theme;


class Application
{

  public function __construct() {
    $this->init();
    new Config();
    new Context();
    new Enqueue();
    new Hooks();
    new Navigation();
    new Structure();
    new Widgets();
    add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
    add_action( 'widgets_init', array( $this, 'widgets' ) );
  }
  public function setup_theme() {
    //add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
  }
  public function init() {
    \Timber::$dirname = array( 'templates' );
  }
  public function widgets() {
  }

}