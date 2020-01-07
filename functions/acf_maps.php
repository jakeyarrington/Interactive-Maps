<?php

	add_action("init", "yim_acf_add_maps");
	add_action('init', 'bootstrap_map_editor');
	add_action('admin_enqueue_scripts', 'add_map_editor_admin_js');
	
	function yim_acf_add_maps() {
	    if (function_exists("acf_add_local_field_group")) {
	        $acf_json_data = (__DIR__ . DIRECTORY_SEPARATOR . 'acf_maps_fields.json');
	        $custom_fields = $acf_json_data ? json_decode(file_get_contents($acf_json_data), true) : array();

	        foreach($custom_fields as &$custom_field) {

	        	$custom_fields_filter = apply_filters('yim/import/fields', $custom_field['fields']);
		        if(is_array($custom_fields_filter)) {
		        	$custom_field['fields'] = $custom_fields_filter;
		        }

	        	foreach($custom_field['fields'] as &$child_field) {
	        		if($child_field['name'] == 'markers') {
		        		$custom_field_filter = apply_filters('yim/import/field/markers', $child_field);
		        		if(is_array($custom_field_filter)) {
		        			$child_field = $custom_field_filter;
		        		}
		        	}
	        	}

	        	

	            acf_add_local_field_group($custom_field);
	        }
	    }
	}

	function bootstrap_map_editor() {
		if(defined('ACF_PRO')) {
			$req = $_SERVER['REQUEST_URI'];
			if(strpos($req, YIM_MAP_EDITOR_URI) !== false && is_user_logged_in()) {
				require YIM_PLUGIN_DIR . '/templates/dropper.php'; die();
			}
		}
	}

	function add_map_editor_admin_js($hook) {
		if(defined('ACF_PRO')) {
		    if ('post.php' !== $hook) {
		        return;
		    }
		    wp_enqueue_script('map_editor_admin_js', plugin_dir_url(__FILE__) . '/js/yim_admin.js');

		}
	}


	if(!defined('ACF_PRO')) {
		add_action( 'admin_notices', 'my_acf_notice' );

		function my_acf_notice() {
		  ?>
		  <div class="notice notice-warning">
		      <p><?php _e( '<strong>Interactive Maps</strong>: Please install Advanced Custom Fields PRO, it is required for Interactive Maps to work', 'yarr_im' ); ?></p>
		  </div>
		  <?php
		}
	} else {
		
	}
?>