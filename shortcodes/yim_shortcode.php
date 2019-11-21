<?php


	add_shortcode('yimap', 'yim_shortcode_map');
	add_action('wp_enqueue_scripts', 'yim_add_shortcode_dependencies');

	function yim_add_shortcode_dependencies() {
		wp_enqueue_script('yim_src_jquery', plugin_dir_url(YIM_PLUGIN_FILE) . 'templates/js/jquery.min.js', array(), '1.0.1', 0);
		wp_enqueue_script('yim_src_fabric', plugin_dir_url(YIM_PLUGIN_FILE) . 'templates/js/fabric.min.js', array(), '1.0.1', 0);
		wp_enqueue_script('yim_src_yim', plugin_dir_url(YIM_PLUGIN_FILE) . 'templates/js/frontend.js', array(), '1.0.1', 0);
		wp_enqueue_style( 'yim_src_yim', plugin_dir_url(YIM_PLUGIN_FILE)  . 'templates/css/frontend.css');
	}

	function yim_shortcode_map($atts) {
		if(!isset($atts['id'])) {
			return "Error loading map, ID not set.";
		}

		$id = intval($atts['id']);
		$instance = uniqid();

		$map = yim_get_maps($id);

		ob_start();
		require YIM_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'embed.php';
		$content = ob_get_contents();
		ob_clean();

		return $content;
	}