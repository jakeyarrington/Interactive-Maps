<?php
	
	function yim_get_maps($id = false) {

		if($id) {
			$posts = array(get_post($id));
		} else {
			$posts = get_posts(array(
				'post_type' => 'map',
				'posts_per_page' => -1
			));
		}

		$maps = array();

		foreach($posts as $post) {

			$image_id 		= get_post_meta($post->ID, 'map', true);
			$get_markers 	= get_field('markers', $post->ID, true);
			$scale 			= floatval(get_post_meta($post->ID, 'scale', true));
			$zoom 			= boolval(get_post_meta($post->ID, 'enable_zoom', true));
			$pan 			= boolval(get_post_meta($post->ID, 'enable_panning', true));

			foreach($get_markers as $id => &$marker) {
				$marker['id'] = $id;
				$marker['map_ID'] = $post->ID;
				$marker['name'] = sanitize_title($marker['name']);
				$marker_filter = apply_filters('yim/create/marker', $marker);
				if(!empty($marker_filter)) {
					$marker = $marker_filter;
				}
			}
			
			$maps[$post->ID] = array(
				'ID'		=> $post->ID,
				'name' 		=> $post->post_title,
				'scale'		=> $scale,
				'image' 	=> wp_get_attachment_image_src($image_id, 'full')[0],
				'markers' 	=> $get_markers,
				'pan'		=> $pan,
				'zoom'		=> $zoom
			);

			$map_filter = apply_filters('yim/create/map', $maps[$post->ID]);
			if(!empty($map_filter)) {
				$maps[$post->ID] = $map_filter;
			}

		}

		return $id ? array_values($maps)[0] : $maps;

	}

?>