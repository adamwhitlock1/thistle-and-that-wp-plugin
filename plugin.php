<?php
/*
Plugin Name: Thistle and That Custom Application Plugin
Plugin URI: https://thistleandthat.com
Description: An advanced floral configurator for wedding arrangements. Built with vue.
Version: 0.3
Author: Madwire Media
Author URI: https://madwire.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: baseplugin
Domain Path: /languages
GitHub Plugin URI: https://github.com/adamwhitlock1/thistle-and-that-plugin
 */

/**
 * Copyright (c) 2019 Madwire Media (email: Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if (!defined('ABSPATH')) {
  exit;
}

define('THISTLE_THAT_MODULES_DIR', plugin_dir_path(__FILE__));
define('THISTLE_THAT_MODULES_URL', plugins_url('/', __FILE__));

require_once THISTLE_THAT_MODULES_DIR . 'includes/class-modules-loader.php';
require_once THISTLE_THAT_MODULES_DIR . 'includes/class-ajax-update-profile.php';
require_once THISTLE_THAT_MODULES_DIR . 'includes/class-ajax-add-composite-product.php';
require_once THISTLE_THAT_MODULES_DIR . 'includes/class-ajax-remove-composite-product.php';


/**
 * Base_Plugin class
 *
 * @class Base_Plugin The class that holds the entire Base_Plugin plugin
 */
final class Thistle_Plugin {

  /**
   * Plugin version
   *
   * @var string
   */
  public $version = '0.1.0';

  /**
   * Holds various class instances
   *
   * @var array
   */
  private $container = array();

  /**
   * Constructor for the Base_Plugin class
   *
   * Sets up all the appropriate hooks and actions
   * within our plugin.
   */
  public function __construct() {

    $this->define_constants();

    register_activation_hook(__FILE__, array($this, 'activate'));
    register_deactivation_hook(__FILE__, array($this, 'deactivate'));

    add_action('plugins_loaded', array($this, 'init_plugin'));
  }

  /**
   * Initializes the Base_Plugin() class
   *
   * Checks for an existing Base_Plugin() instance
   * and if it doesn't find one, creates it.
   */
  public static function init() {
    static $instance = false;

    if (!$instance) {
      $instance = new Thistle_Plugin();
    }

    return $instance;
  }

  /**
   * Magic getter to bypass referencing plugin.
   *
   * @param $prop
   *
   * @return mixed
   */
  public function __get($prop) {
    if (array_key_exists($prop, $this->container)) {
      return $this->container[$prop];
    }

    return $this->{$prop};
  }

  /**
   * Magic isset to bypass referencing plugin.
   *
   * @param $prop
   *
   * @return mixed
   */
  public function __isset($prop) {
    return isset($this->{$prop}) || isset($this->container[$prop]);
  }

  /**
   * Define the constants
   *
   * @return void
   */
  public function define_constants() {
    define('THISTLE_VERSION', $this->version);
    define('THISTLE_FILE', __FILE__);
    define('THISTLE_PATH', dirname(THISTLE_FILE));
    define('THISTLE_INCLUDES', THISTLE_PATH . '/includes');
    define('THISTLE_URL', plugins_url('', THISTLE_FILE));
    define('THISTLE_ASSETS', THISTLE_URL . '/assets');
  }

  /**
   * Load the plugin after all plugis are loaded
   *
   * @return void
   */
  public function init_plugin() {
    $this->includes();
    $this->init_hooks();
  }

  /**
   * Placeholder for activation function
   *
   * Nothing being called here yet.
   */
  public function activate() {

    $installed = get_option('thistleplugin_installed');

    if (!$installed) {
      update_option('thistleplugin_installed', time());
    }

    update_option('thistleplugin_version', THISTLE_VERSION);
  }

  /**
   * Placeholder for deactivation function
   *
   * Nothing being called here yet.
   */
  public function deactivate() {

  }

  /**
   * Include the required files
   *
   * @return void
   */
  public function includes() {

    require_once THISTLE_INCLUDES . '/class-assets.php';
    require_once THISTLE_INCLUDES . '/custom-fields.php';
    require_once THISTLE_INCLUDES . '/rest-endpoints/custom-user-info-rest.php';
    require_once THISTLE_INCLUDES . '/rest-endpoints/custom-order-status-rest.php';
    require_once THISTLE_INCLUDES . '/generate-product-data.php';

    if ($this->is_request('admin')) {
      require_once THISTLE_INCLUDES . '/class-admin.php';
    }

    if ($this->is_request('frontend')) {
      require_once THISTLE_INCLUDES . '/class-frontend.php';
    }

    if ($this->is_request('ajax')) {
      // require_once BASEPLUGIN_INCLUDES . '/class-ajax.php';
    }

    if ($this->is_request('rest')) {
      require_once THISTLE_INCLUDES . '/class-rest-api.php';
    }
  }

  /**
   * Initialize the hooks
   *
   * @return void
   */
  public function init_hooks() {

    add_action('init', array($this, 'init_classes'));

    // Localize our plugin
    add_action('init', array($this, 'localization_setup'));
  }

  /**
   * Instantiate the required classes
   *
   * @return void
   */
  public function init_classes() {

    if ($this->is_request('admin')) {
      $this->container['admin'] = new App\Admin();
    }

    if ($this->is_request('frontend')) {
      $this->container['frontend'] = new App\Frontend();
    }

    if ($this->is_request('ajax')) {
      // $this->container['ajax'] =  new App\Ajax();
    }

    if ($this->is_request('rest')) {
      $this->container['rest'] = new App\REST_API();
    }

    $this->container['assets'] = new App\Assets();
  }

  /**
   * Initialize plugin for localization
   *
   * @uses load_plugin_textdomain()
   */
  public function localization_setup() {
    load_plugin_textdomain('thistleplugin', false, dirname(plugin_basename(__FILE__)) . '/languages/');
  }

  /**
   * What type of request is this?
   *
   * @param  string $type admin, ajax, cron or frontend.
   *
   * @return bool
   */
  private function is_request($type) {
    switch ($type) {
    case 'admin':
      return is_admin();

    case 'ajax':

      return defined('DOING_AJAX');

    case 'rest':
      return defined('REST_REQUEST');

    case 'cron':
      return defined('DOING_CRON');

    case 'frontend':
      return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
    }
  }

} // Base_Plugin

$baseplugin = Thistle_Plugin::init();

// add link to the app on the user's account page
add_action('woocommerce_account_dashboard', 'thistle_that_account_dash_link');

function thistle_that_account_dash_link() {
  echo '<h3>Ready To Start Designing Your Wedding?</h3><p>Get started now.</p><a href="/design-your-wedding" class="btn btn-primary">Launch The App</a>';
}

function gen_state_data($args)
{
  $uploads_path = wp_upload_dir();
  $save_path = $uploads_path['basedir'];
  $cart_data_file = fopen($save_path . '/all_state_data.json', "w");
  fwrite($cart_data_file, json_encode($args));
  fclose($cart_data_file);
}

add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id, $variation_id) {


  if (!empty($_POST['all_state'])) {
    // Add the item data
    if (array_key_exists("composite_data", $cart_item_data) && !array_key_exists("composite_parent", $cart_item_data)) {
      $cart_item_data['all_state'] = json_decode(stripslashes($_POST['all_state']));
      $state_data = json_decode(stripslashes($_POST['all_state']));
      $data_to_write = [];
      $bridal_bouquet_ribbon_color = $state_data->activeSelections->bridal[0]->ribbon_color_name;
      $bridesmaids_bouquet_ribbon_color = $state_data->activeSelections->bridesmaids[0]->ribbon_color_name;
      $mothers_bouquet_ribbon_color = $state_data->activeSelections->mothers[0]->ribbon_color_name;
      $flowergirl_bouquet_ribbon_color = $state_data->activeSelections->flowergirl[0]->ribbon_color_name;


      array_push($data_to_write, $bridal_bouquet_ribbon_color);

      // "bridal_bouquet_qty": 1,
      // "bridesmaids_qty": 4,
      // "mothers_qty": 2,
      // "grandmothers_qty": 4,
      // "flowergirl_qty": 0,
      // "groom_qty": 1,
      // "groomsmen_qty": 4,
      // "fathers_qty": 2,
      // "grandfathers_qty": 4,
      // "ring_bearer_qty": 1,
      // "centerpieces_qty": 20,
      // "candles_qty": 30,
      // "vases_qty": 0,
      // "linens_qty": 0,

      gen_state_data(json_decode( stripslashes($_POST['all_state']) ) );
      // gen_state_data( $data_to_write );

    }
  } else {
    $cart_item_data['all_state'] = "NO STATE SENT";
  }
  return ($cart_item_data);
}, 10, 4);

function parse_state_items($state) {

  $printed_items = "";

  foreach ($state as $state_key => $state_item) {
    if ($state_key !== 'wedding_date'){
      $printed_items .= ucfirst(str_replace("_", " ", $state_key)) . ": " . ucfirst(str_replace("_", " ", $state_item)) . " | ";
    }
  }
  return $printed_items;
}

function add_state_to_order_items($item, $cart_item_key, $values, $order) {
  $state_object = parse_state_items($values['all_state']->overviewForm);
  if (empty($state_object)) {
    return;
  }
  if (array_key_exists("composite_data", $values) && !array_key_exists("composite_parent", $values)) {
    $item->add_meta_data(__('Additional Details', 'thistle'), $state_object);
  }
  return;
}
add_action('woocommerce_checkout_create_order_line_item', 'add_state_to_order_items', 10, 4);

function add_wedding_data_to_order_items($item, $cart_item_key, $values, $order) {
  $wedding_date = $values['all_state']->overviewForm->wedding_date;

  $bridal_bouquet_ribbon_color = $values['all_state']->activeSelections->bridal[0]->ribbon_color_name;
  $bridesmaids_bouquet_ribbon_color = $values['all_state']->activeSelections->bridesmaids[0]->ribbon_color_name;
  $mothers_bouquet_ribbon_color = $values['all_state']->activeSelections->mothers[0]->ribbon_color_name;
  $flowergirl_bouquet_ribbon_color = $values['all_state']->activeSelections->flowergirl[0]->ribbon_color_name;

  if (empty($wedding_date)) {
    return;
  }
  if (array_key_exists("composite_data", $values) && !array_key_exists("composite_parent", $values)) {
    $item->add_meta_data(__('Wedding Date: ', 'thistle'), $wedding_date);
    $item->add_meta_data(__('Bridal Ribbon Color', 'thistle'), $bridal_bouquet_ribbon_color);
    $item->add_meta_data(__('Bridesmaids Ribbon Color', 'thistle'), $bridesmaids_bouquet_ribbon_color);
    $item->add_meta_data(__('Mothers Ribbon Color', 'thistle'), $mothers_bouquet_ribbon_color);
    $item->add_meta_data(__('Flower Girl Ribbon Color', 'thistle'), $flowergirl_bouquet_ribbon_color);
  }
  return;
}

add_action('woocommerce_checkout_create_order_line_item', 'add_wedding_data_to_order_items', 10, 4);


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Design Your Wedding Settings',
		'menu_title'	=> 'Thistle & That Settings',
		'menu_slug' 	=> 'thistle-general-settings',
    'capability'	=> 'edit_posts',
    'icon_url' => 'dashicons-palmtree',
    'redirect'		=> false,
    'position'    => "2.2"
	));
}


