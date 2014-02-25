<?php
if (!function_exists('check_main_heading')) {
	function check_main_heading() {
		$options = get_option('woo_template');
		if (!in_array("Canvas Extensions", $options)) {
			function woo_options_add($options){
				$i = count($options);
				$options[$i++] = array(
						'name' => __('Canvas Extensions', 'pootlepress-canvas-extensions' ), 
						'icon' => 'favorite', 
						'type' => 'heading'
						);
				return $options;
			}
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
	
	/* Centre primary navigation menu */
	function center_nav_css() { ?>

		<style>
			/*Not mobile*/
			@media only screen and (min-width: 768px) {
				#navigation { position: relative; }
				#main-nav { position: relative; left: 50%; text-align: center; }
				#main-nav.nav li { display: block; float: left; list-style: none; margin: 0; padding: 0;
					position: relative; right: 50%; }
				#main-nav.nav li ul li { left: 0; }
			}
 
		</style>

	<?php
}

	
	/* Centre top menu */
	function center_topmenu_css() { ?>

		<style>
			/*Not mobile*/
			@media only screen and (min-width: 768px) {
				#top-nav { position: relative; left: 50%; text-align: center; }
				#top-nav.nav li { display: block; float: left; list-style: none; margin: 0; padding: 0;
					position: relative; right: 50%; }
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