<body class="active">
	<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>/css/style.css">
	<script src="<?php echo plugin_dir_url(__FILE__); ?>/js/fabric.min.js"></script>
	<script src="<?php echo plugin_dir_url(__FILE__); ?>/js/jquery.min.js"></script>
	<?php 
		$refer = (parse_url($_SERVER['HTTP_REFERER'])); 
		parse_str($refer['query'], $get_array);

		if(!isset($get_array['post'])) {
			die('You must launch the editor from within inside a Map post.');
		}	

		$post_id = intval($get_array['post']);

		$scale = get_post_meta($post_id, 'scale', true);
		$markers = get_field('markers', $post_id);

		$image_id = get_post_meta($post_id, 'map', true);

	?>
	<button>Toggle Zoom</button>
	<canvas id="c" width="500" height="500"></canvas>
	<script>
		var YIM = {};
		YIM.markers = JSON.parse('<?php echo json_encode($markers); ?>');
		YIM.image = '<?php echo wp_get_attachment_image_src($image_id, 'full')[0]; ?>';
	</script>
	<script src="<?php echo plugin_dir_url(__FILE__); ?>/js/dropper.js"></script>
</body>