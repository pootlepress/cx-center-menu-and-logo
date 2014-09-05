<?php
$health = 'ok';

if (!function_exists('check_main_heading')) {
    function check_main_heading() {
        global $health;
        if (!function_exists('woo_options_add') ) {
            function woo_options_add($options) {
                $cx_heading = array( 'name' => __('Canvas Extensions', 'pootlepress-canvas-extensions' ),
                    'icon' => 'favorite', 'type' => 'heading' );
                if (!in_array($cx_heading, $options))
                    $options[] = $cx_heading;
                return $options;
            }
        } else {	// another ( unknown ) child-theme or plugin has defined woo_options_add
            $health = 'ng';
        }
    }
}

add_action( 'admin_init', 'poo_commit_suicide' );

if(!function_exists('poo_commit_suicide')) {
    function poo_commit_suicide() {
        global $health;
        $pluginFile = str_replace('-functions', '', __FILE__);
        $plugin = plugin_basename($pluginFile);
        $plugin_data = get_plugin_data( $pluginFile, false );
        if ( $health == 'ng' && is_plugin_active($plugin) ) {
            deactivate_plugins( $plugin );
            wp_die( "ERROR: <strong>woo_options_add</strong> function already defined by another plugin. " .
                $plugin_data['Name']. " is unable to continue and has been deactivated. " .
                "<br /><br />Please contact PootlePress at <a href=\"mailto:support@pootlepress.com?subject=Woo_Options_Add Conflict\"> support@pootlepress.com</a> for additional information / assistance." .
                "<br /><br />Back to the WordPress <a href='".get_admin_url(null, 'plugins.php')."'>Plugins page</a>." );
        }
    }
}

	/* Centre logo */
		// http://www.dalesue.com/how-to-centrify-the-logo-in-canvas
	function center_logo_css() { ?>

		<style> 
	
			#logo { width:100%; text-align: center; }
 
		</style>

	<?php
}

	/* Remove Search widget from navigation menu */
	function hide_search_widget_css() { ?>

		<style>
			/*Not mobile*/
			@media only screen and (min-width: 768px) {
				ul.nav-search { display:none; }
			}
 
		</style>

	<?php
}


	/* Centre primary navigation menu */
	function center_nav_css() { ?>

		<style>
			/*Not mobile*/
			@media only screen and (min-width: 768px) {
				#navigation { position: relative; }
				#main-nav { position: relative; left: 0; text-align: center; width: 100%; }
				#main-nav.nav li { display: inline-block; float: none; list-style: none; margin: 0; padding: 0;
					position: relative; vertical-align: middle; }
				#main-nav.nav li ul li { left: 0; }

                #navigation .side-nav .cart .cart-contents  { width: auto; text-indent: 0; }
			}
 
		</style>

	<?php
}

	
	/* Centre top menu */
	function center_topmenu_css() { ?>

		<style>
			/*Not mobile*/
			@media only screen and (min-width: 768px) {
				#top-nav { position: relative; text-align: center; left: 0; width: 100%; }
				#top-nav.nav li { display: inline-block; float: none; list-style: none; margin: 0; padding: 0;
					position: relative; vertical-align: middle;  }
				#top-nav.nav li ul li { left: 0; }
			}

 
		</style>
	
	<?php
}


/*
	<script type="text/javascript">
		jQuery(function ($) {
			$(document).ready(function() {
				var navhiddenHeight = '<? echo $navhiddenHeight; ?>';
				var navhiddenMargin = '<? echo $navhiddenMargin; ?>';
				var navid = '<? echo $_navid; ?>';
				var stickNavOffset = $(navid).offset().top;
				var contentWidth;
			});
		});
	</script>
*/


?>