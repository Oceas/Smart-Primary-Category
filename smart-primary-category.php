<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*
Plugin Name:  Smart Primary Category
Plugin URI:   https://scottkeithanderson.com/smart-primary-category
Description:  Easily tag your WordPress content with a parent category and fetch it.
Version:      0.1
Author:       Scott Anderson
Author URI:   https://scottkeithanderson.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
 * @TODO Internationalize
 */

// Plugin Paths
define('SPC_PATH', plugin_dir_path(__FILE__));

/*
 * @TODO Create Meta Box for Parent Post
 */
include SPC_PATH . 'includes/spc-meta-box.php';
$spec_meta_box = new SPC_Primary_Category_Meta_Data();

/*
 * @TODO Create Shortcode to display posts by Parent Category
 */

// RMS 12:2
?>
