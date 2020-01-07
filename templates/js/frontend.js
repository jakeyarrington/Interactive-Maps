(function($) {

	window.YIM = {
		map: function($name) {
			if(!$name) {
				return window.YIM_INSTANCE;
			}
			return typeof window.YIM_INSTANCE[$name] !== 'undefined' ? window.YIM_INSTANCE[$name] : false;
		}
	};

	window.YIM_FE = function() {

		return {
			init: function($id, $config) {
				this.id = $id;

				this.canvas = new fabric.Canvas($id);
				this.canvas.selection = false;
				this.canvas.preserveObjectStacking = true;

				this.config = $config;
				this.markers = [];
				this.bg;
				this.group;

				this.render();

				return this;
			},
			marker: function($name) {
				var $that = this;

				if(!$name) {
					return $that.markers;
				}
				for (var i = 0; i < $that.markers.length; i++) {
					var marker = $that.markers[i];
					if(marker.$data.name == $name) {
						return marker;
					}
				}

				return false;
			},
			render: function() {
				var $that = this;
				fabric.Image.fromURL(this.config.image, function(img) {
						
					$that.bg = img;

					img.set({
						left: 0,
						top: 0,
						hasBorders: false,
						hasControls: false,
						selectable: $that.config.pan
					});

					var group_arr = [img];
					var pan; 

					img.on('moving', function(e) {
						

						for (var i = 0; i < $that.markers.length; i++) {
							var marker = $that.markers[i];
							marker.set({
								top: (parseFloat(marker.$data.posy) + $that.bg.translateY),
								left: (parseFloat(marker.$data.posx) + $that.bg.translateX)
							});

							marker.setCoords();
						}

						$that.canvas.renderAll();
					});

					img.scale($that.config.scale);
					$that.canvas.add(img);



					for (var i = $that.config.markers.length - 1; i >= 0; i--) {
						var rect = $that.config.markers[i];
						var marker = new fabric.Rect({

							left: parseFloat(rect.posx),
							top: parseFloat(rect.posy),
							width: parseFloat(rect.width),
							height: parseFloat(rect.height),
							fill: (typeof rect.fill !== 'undefined' ? rect.fill : 'rgba(0,0,0,0.1)'),
							$data: rect,
							selectable: false

						});

						$that.markers.push(marker);
						$that.canvas.add(marker);
						marker.moveTo(1);
					}

					$that.group = new fabric.Group(group_arr, {
						hasBorders: false,
						hasControls: false
					});

				
				});

				return this;

			}
		};
	}

})(jQuery);