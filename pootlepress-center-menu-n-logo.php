<?php
/*
Plugin Name: Canvas Extension - Center Menu & Logo
Plugin URI: http://pootlepress.com/canvas-extensions
Description: An extension for WooThemes Canvas that offers the option to align the logo in the middle of the header, center the primary navigation, and center the top menu. This plugin also offers the option of removing the search widget from the navigation menu.
Version: 1.1.0
Author: PootlePress
Author URI: http://pootlepress.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
/*  Copyright 2014  Pootlepress  (email : jamie@pootlepress.co.uk)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
    if ( ! defined( 'ABSPATH' ) ) exit;				// Exit if accessed directly
	require_once( 'pootlepress-center-menu-n-logo-functions.php' );
	require_once( 'classes/class-center-menu-n-logo.php' );
    require_once( 'classes/class-pootlepress-updater.php');

    $GLOBALS['pootlepress_center_mnl'] = new Pootlepress_Center_Menu_N_Logo( __FILE__ );
    $GLOBALS['pootlepress_center_mnl']->version = '1.1.0';

add_action('init', 'pp_cmnl_updater');
function pp_cmnl_updater()
{
    if (!function_exists('get_plugin_data')) {
        include(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    $data = get_plugin_data(__FILE__);
    $wptuts_plugin_current_version = $data['Version'];
    $wptuts_plugin_remote_path = 'http://www.pootlepress.com/?updater=1';
    $wptuts_plugin_slug = plugin_basename(__FILE__);
    new Pootlepress_Updater ($wptuts_plugin_current_version, $wptuts_plugin_remote_path, $wptuts_plugin_slug);
}
?>