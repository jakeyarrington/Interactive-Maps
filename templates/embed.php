<canvas 
class="yim--map yim--theme-default"
id="c-<?php echo $instance; ?>" 
width="<?php echo isset($atts['width']) ? $atts['width'] : 500; ?>" 
height="<?php echo isset($atts['width']) ? $atts['height'] : 500; ?>">
</canvas>
<script>
	(function($) { 
		
		$(document).ready(function() {
			var app = YIM_FE();
			if(typeof window.YIM_INSTANCE !== 'object') { 
				window.YIM_INSTANCE = {}; 
			}
				
			window.YIM_INSTANCE['<?php echo sanitize_title($map['name']); ?>'] = app.init('c-<?php echo $instance; ?>', <?php echo json_encode($map); ?>); 
		});

	})(jQuery);
</script>