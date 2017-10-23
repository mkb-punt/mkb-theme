<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:14
 */

namespace MKB\Theme;


class Context
{
  public function __construct() {
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    //add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
  }

  public function add_to_context( $context ) {

    $user = wp_get_current_user();
    $context['theme'] = array(
      'url' => get_template_directory_uri(),
    );

    $context['site'] = array(
      'name' => get_bloginfo( 'name' ),
      'description' => get_bloginfo( 'description' ),
      'url' => get_bloginfo( 'url' ),
      'url_logout' => wp_logout_url( get_bloginfo( 'url' ) ),
      'front_page' => is_front_page(),
    );

    $context['user'] = $user->ID ? true : false;

    return $context;
  }

  public function add_to_twig( $twig ) {

    $twig->addFilter(new Twig_SimpleFilter('example', function( $param ) {
      //do something with $param
    }));

    return $twig;
  }
}