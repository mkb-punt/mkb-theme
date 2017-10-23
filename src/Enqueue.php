<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:15
 */

namespace MKB\Theme;


class Enqueue
{

  /**
   * Enqueue constructor.
   */
  public function __construct() {
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );
    add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_scripts' ), 100 );
  }

  public function dequeue_scripts() {
    wp_dequeue_style( 'fw-ext-forms-default-styles' );
    if (function_exists( 'fw' ) ) {
      fw()->backend->option_type( 'icon-v2' )->packs_loader->enqueue_frontend_css();
    }
  }

  public function enqueue_scripts() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script('jquery' );

    $mode = Config::get( 'mode' );
    $min = ( 'dev' === $mode ) ? '' : '.min';

    $script = Config::get( 'scripts' );
    $arr = array();

    if ( ! empty( $script ) ) {
      foreach ( $script as $k => $v ) {
        $arr['key'] = $k;
        $arr['footer'] = isset( $v['footer'] ) ? $v['footer'] : true;

        if ( 'http' === substr( $v['url'], 0, 4 ) ) {
          $arr['url'] = $v['url'];
        } else {
          $arr['url'] = get_stylesheet_directory_uri() . '/' . $v['url'] . $min . '.js';
        }
        $this->enqueue( 'script', $arr );
      }
    }
  }

  public function enqueue_styles() {
    $styles = Config::get( 'styles' );

    if ( $styles ) {
      $mode = Config::get( 'mode' );
      $min = ( 'dev' === $mode ) ? '' : '.min';
      foreach ( $styles as $k => $v ) {
        $arr['key'] = $k;
        if ( 'http' === substr( $v['url'], 0, 4 ) ) {
          $arr['url'] = $v['url'];
        } else {
          $arr['url'] = get_stylesheet_directory_uri() . '/' . $v['url'] . $min . '.css';
        }
        $this->enqueue( 'style', $arr );
      }
    }
  }

  public function enqueue( $type = 'script', $arr ) {
    $mode = Config::get( 'mode' );
    $version = ( 'dev' === $mode ) ? time() : Config::get( 'version' );
    if ( 'script' === $type ) {
      wp_enqueue_script(
        $arr['key'],
        $arr['url'],
        array(),
        $version,
        $arr['footer']
      );
    } else {
      wp_enqueue_style(
        $arr['key'],
        $arr['url'],
        array(),
        $version
      );
    }
  }

}