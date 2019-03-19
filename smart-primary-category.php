<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*
Plugin Name:  Smart Primary Category
Plugin URI:   https://scottkeithanderson.com/smart-primary-category
Description:  Easily tag your WordPress content with a parent category and fetch it.
Version:      1.0
Author:       Scott Anderson
Author URI:   https://scottkeithanderson.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/


// Plugin Paths
define('SPC_PATH', plugin_dir_path(__FILE__));

/*
 * Create Meta Box for Parent Post
 */

include SPC_PATH . 'includes/spc-meta-box.php';
$spc_meta_data = new SPC_Primary_Category_Meta_Data();

/*
 * Create Shortcode to display posts by Parent Category
 */

include SPC_PATH . 'includes/spc-short-code.php';
$spc_shortcode = new SPC_Primary_Category_Shortcode();

// RMS 12:2
?>
