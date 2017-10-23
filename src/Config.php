<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 06/07/2017
 * Time: 00:08
 */

namespace MKB\Theme;
use Symfony\Component\Yaml\Yaml;


/**
 * Class Config
 * @package MKB\Theme
 */
class Config
{
  public static $config = array();

  /**
   * Config constructor.
   */
  public function __construct()
  {
    self::get_yaml();
  }

  public static function get($key = false)
  {
    if ($key) {
      $keys = explode('.', $key);
      $config = self::$config;
      foreach ($keys as $k) {
        $config = isset($config[$k]) ? $config[$k] : false;
      }
    } else {
      $config = self::$config;
    }
    return $config;
  }

  /**
   * @param $key
   * @param $val
   */
  public static function set($key, $val)
  {
    array_push(self::$config, array($key, $val));
  }

  /**
   * Parse yaml
   */
  public function get_yaml()
  {
    self::$config = Yaml::parse(file_get_contents(get_stylesheet_directory() . '/inc/config.yml', true), false);
  }
}