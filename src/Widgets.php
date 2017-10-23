<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:20
 */

namespace MKB\Theme;


class Widgets
{

  public $area = array();

  public function __construct() {
    $this->init();
    add_action( 'widgets_init', array( $this, 'register' ) );
  }

  public function init() {
    $this->area = Config::get( 'widgets' );
  }

  /**
   * Register Sidebar for widgets
   */
  public function register() {

    $sidebars = $this->area;
    if ( $sidebars ) {
      foreach ( $sidebars as $id => $v ) {
        $title_size = isset( $v['title_size'] ) ? $v['title_size'] : 'h3';
        $title_class = isset( $v['title_class'] ) ? $v['title_class'] : 'widget-title';
        $arg = array(
          'name'          => $v['name'],
          'id'            => $id,
          'description'   => $v['desc'],
          'class'         => '',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<' . $title_size . ' class="' . $title_class . '">',
          'after_title'   => '</' . $title_size . '>',
        );
        register_sidebar( $arg );
      }
    }
  }

}