<?php
/*
Plugin Name: Canvas Extension - Center Menu & Logo
Plugin URI: http://pootlepress.com/canvas-extensions
Description: An extension for WooThemes Canvas that offers the option to align the logo in the middle of the header, center the primary navigation, and center the top menu.
Version: 0.2.0
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
	require_once( 'pootlepress-center-mnl-functions.php' );
	require_once( 'classes/class-center-menu-n-logo.php' );
    $GLOBALS['pootlepress_center_mnl'] = new Pootlepress_Center_Menu_N_Logo( __FILE__ );
    $GLOBALS['pootlepress_center_mnl']->version = '0.2.0';
?>