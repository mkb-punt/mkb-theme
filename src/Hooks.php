<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:18
 */

namespace MKB\Theme;


class Hooks
{

  public function __construct() {
    add_filter( 'excerpt_length', array( $this, 'set_excerpt_length' ) );
  }

  public function set_excerpt_length() {
    $length = Config::get( 'excerpt' );
    return $length ? $length : 40;
  }

}