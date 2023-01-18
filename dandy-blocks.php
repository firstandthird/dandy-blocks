<?php
/**
 * Plugin Name: Dandy Plugins
 * Description: A collection of Gutenberg blocks built on top of ACF.
 * Version: 1.1.0
 * Author: First+Third
 * Author URI: https://firstandthird.com
 * Requires at least: 5.9.0
 * Requires PHP: 7
 */

namespace FirstAndThird\Dandy;

class Dandy_Blocks {
  static $plugin_path = '';
  static $theme_path = '';
  static $category = 'dandy-blocks';
  static $theme_category = 'custom-blocks';
  static $name = 'Dandy Blocks';
  static $theme_name = 'Custom Blocks';

  static function init() {
    self::$plugin_path = plugin_dir_path(__FILE__);
    self::$theme_path = get_stylesheet_directory();

    add_filter('acf/settings/load_json', ['FirstAndThird\Dandy\Dandy_Blocks', 'register_acf_fields_path']);
    add_filter('block_categories_all', ['FirstAndThird\Dandy\Dandy_Blocks', 'register_block_category'], 10, 2 );
    add_action('init', ['FirstAndThird\Dandy\Dandy_Blocks', 'register_blocks']);
    add_action('admin_init', ['FirstAndThird\Dandy\Dandy_Blocks', 'register_editor_styles']);
    add_action('wp_enqueue_scripts', function() {
      wp_enqueue_style('dandy-blocks', plugin_dir_url(__FILE__) . 'dist/dandy-blocks.css', array());
    });
  }

  static function log($message) {
    if (!WP_DEBUG) {
      return;
    }

    //phpcs:disable WordPress.PHP.DevelopmentFunctions.error_log_print_r,WordPress.PHP.DevelopmentFunctions.error_log_error_log --  This is only run in development
    if (is_array($message) || is_object($message)) {
      error_log(print_r($message, true));
      return;
    }

    error_log($message);
    //phpcs:enable
  }

  static function register_editor_styles() {
    wp_enqueue_style('dandy-blocks-editor', plugins_url('dist/editor-style.css', __FILE__));
  }

  static function register_acf_fields_path($paths) {
    $paths[] = self::$plugin_path . 'acf-fields';

    return $paths;
  }

  static function register_block_category($categories) {
    return array_merge(
      $categories,
      [
        [
          'slug' => self::$category,
          'title' => self::$name,
          'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M68.2 10a1 1 0 0 0-.4 0v.1a1 1 0 0 0-.3.2s-5.2 4.9-17.5 7.2a36.4 36.4 0 0 1-17.5-7.2 1 1 0 0 0-.2-.2h-.1a1 1 0 0 0-.4-.1c-.4 0-10.1 0-21.4 7.6a1 1 0 1 0 1.2 1.7 43 43 0 0 1 18.2-7.1l-12.1 16a1 1 0 0 0 0 1.2L25.1 40l-6.6 7a1 1 0 0 0-.1 1.2l30.7 41.4a1 1 0 0 0 1.6 0l30.7-41.4a1 1 0 0 0 0-1.3L74.7 40l7.6-10.6a1 1 0 0 0 0-1.2l-12.2-16a43 43 0 0 1 18.2 7 1 1 0 1 0 1.2-1.6A41.7 41.7 0 0 0 68.2 10zm-21 9-11 6.4-2.8-12c2.5 1.7 7 4 13.8 5.6zm-6.7 6.2c1.7 2.6 3.8 4.1 5 4.8l-5.2 13-3.6-15.6 3.8-2.2zM20.6 47.7l6.6-6.9a1 1 0 0 0 0-1.3l-7.5-10.7 11.7-15.4L48 84.7l-27.4-37zM49 80.1l-7.8-33.6 6.4-16.6V29l-.1-.2-.3-.2-.1-.1s-2.8-1.3-4.9-4.4l6.8-4V80zm17.6-66.6-2.8 11.9-11-6.4c6.9-1.6 11.3-4 13.8-5.5zm-3.3 14L59.7 43l-5.1-13c1.1-.7 3.2-2.2 5-4.8l3.7 2.2zM51 20.2l6.8 4c-2.1 3-4.9 4.3-4.9 4.3l-.1.1-.2.1-.1.2-.1.1v.8l6.4 16.6L51 80V20.3zm29.3 8.5-7.6 10.7a1 1 0 0 0 .1 1.3l6.6 7L52 84.6l16.6-71.3 11.7 15.4z"/></svg>'
        ],
        [
          'slug' => self::$theme_category,
          'title' => self::$theme_name
        ]
      ]
    );
  }

  static function register_blocks() {
    if (!function_exists('acf_register_block_type')) {
      self::log('ACF not available. Dandy Blocks requires ACF to be enabled.');
      return;
    }

    // load v6 plugin blocks
    if (is_dir(self::$plugin_path . '/blocks')) {
      foreach (new \DirectoryIterator(self::$plugin_path . '/blocks') as $file) {
        if ($file->isDir()) {
          register_block_type(self::$plugin_path . '/blocks/' . $file->getFilename());
        }
      }
    }

    // load v6 theme blocks
    if (is_dir(self::$theme_path . '/blocks')) {
      foreach (new \DirectoryIterator(self::$theme_path . '/blocks') as $file) {
        if ($file->isDir()) {
          register_block_type(self::$theme_path . '/blocks/' . $file->getFilename());
        }
      }
    }
  }
}

Dandy_Blocks::init();
