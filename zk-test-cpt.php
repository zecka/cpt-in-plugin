<?php
/*
Plugin Name: ZK Test CPT
Description: Create a custom post type inside a plugin
Author: Robin Ferrari
Version: 0.0.1
Author URI: http://robinferrari.ch
*/

// Register Custom Post Type
function test_post_type() {
  $args = array(
    'label'               => __('Test', 'text_domain'),
    'description'         => __('Post Type Description', 'text_domain'),
    'supports'            => array('title', 'editor'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type('test', $args);

}
add_action('init', 'test_post_type', 0);

add_filter('template_include', 'my_plugin_templates');
function my_plugin_templates($template) {
  $post_types = array('test');

  if (is_post_type_archive($post_types) && !file_exists(get_stylesheet_directory() . '/archive-test.php')) {
    $template = plugin_dir_path( __FILE__ ) . 'archive-test.php';
  }

  if (is_singular($post_types) && !file_exists(get_stylesheet_directory() . '/single-test.php')) {
    $template = plugin_dir_path(__FILE__) . 'single-test.php';
  }

  return $template;
}
