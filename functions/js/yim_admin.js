(function($) {	

	window.__launch_map_editor = function(e) {
		var rowid = $(e).closest('tr.acf-row').attr('data-id');
		var href = location.href.split('/wp-admin/')[0] + '/wp-admin/map-editor' + '#' + rowid;
		console.log(href);

		window.open(
			href,
			'mywin',
			'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='+(screen.width/2)+',height='+(screen.height/2)
		);
	}

	window.__map_editor_callback = function(e) {
		console.log(e);
		var el = $('tr.acf-row[data-id="'+ e.id +'"]');

		var name = el.find('div[data-name="name"] input');

		if(name.val().length < 1) {
			name.val(e.id);
		}

		el.find('div[data-name="posx"] input').val(e.left);
		el.find('div[data-name="posy"] input').val(e.top);
		el.find('div[data-name="width"] input').val(e.width);
		el.find('div[data-name="height"] input').val(e.height);
	}

})(jQuery);