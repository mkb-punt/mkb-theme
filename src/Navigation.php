<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:19
 */

namespace MKB\Theme;


class Navigation
{

  public function __construct() {
    add_action( 'after_setup_theme', array( $this, 'register' ) );
    add_filter( 'pk_context', array( $this, 'add_to_context' ) );
    add_filter( 'wp_nav_menu_args', array( $this, 'change_menu' ) );
  }

  public function add_to_context() {
    if ( null !== Config::get( 'menus' ) ) {
      $navs = apply_filters( 'pk_nav', Config::get( 'menus' ) );
      foreach ( $navs as $location => $description ) {
        $context[ $location ] = new \TimberMenu( $location );
      }
    }
    return $context;
  }

  public function register() {
    if ( null !== Config::get( 'menus' ) ) {
      $navigation = apply_filters( 'pk_nav', Config::get( 'menus' ) );
      if ( $navigation ) {
        foreach ( $navigation as $location => $description ) {
          register_nav_menus( array( $location => $description ) );
        }
      }
    }
  }

  public function change_menu( $args ) {
    $args['menu_class'] = 'no-bullet';
    return $args;
  }
  
}