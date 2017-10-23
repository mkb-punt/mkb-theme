<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:21
 */

namespace MKB\Theme;

use Symfony\Component\Yaml\Yaml;


class Structure
{
  public function __construct() {
    $this->init();
  }

  /**
   *
   */
  public function init() {
    //Structure > Positions
    $this->render( 'structure', Config::get( 'structure.positions' ) );

    //Structure > Components
    $this->render( 'components', Config::get( 'structure.components' ) );
  }

  /**
   * @param $type
   * @param $arr
   */
  public function render( $type, $arr ) {
    if ( $arr ) {
      foreach ( $arr as $position => $mod ) {
        if ( is_array( $mod ) ) {
          foreach ( $mod as $m ) {
            $this->do_action( $position, $type, $m );
          }
        } else {
          $this->do_action( $position, $type, $mod );
        }
      }
    }
  }

  public function do_action( $position, $type, $mod ) {
    add_action( $position, function () use ( $type, $mod ) {
      $context = self::get_context( $type, $mod );
      \Timber::render( 'templates/' . $type . '/' . $mod . '/template.twig', $context );
    });
  }

  public static function get_context( $type, $key ) {
    $file = get_template_directory() . '/templates/' . $type . '/' . $key . '/context.php';
    if ( file_exists( $file ) ) {
      $context = require( $file );
    } else {
      $context = array();
    }

    return $context;
  }

}