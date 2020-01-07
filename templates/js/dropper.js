(function() {

	$('button').on('click', function() {
		$(this).toggleClass('edit-mode');
		$('body').toggleClass('active');
	});


	var canvas = new fabric.Canvas('c');
	var $cont = $('.canvas-container');
	var $canvasEle = $('#c');
	var x, y = 0;
	window.c = canvas;
	canvas.selection = false;
	var total = 0;
	var rect, isDown, origX, origY, active, init;

	

	fabric.Image.fromURL(YIM.image, function(img) {
	  
		img.set({
			left: 0,
			top: 0,
			selectable: false,
			hasBorders: false,
			hasControls: false
		});

		canvas.setWidth( img.width );
		canvas.setHeight( img.height );
		canvas.calcOffset();

	  	canvas.on('mouse:move', function(e) {

	  		

	  		if(typeof rect !== 'object') {
	  			return;
	  		}

	  		var e = canvas.getActiveObject();
	  		if(typeof e == 'undefined') {
	  			return;
	  		}

	  		console.log(e);
	  		if(typeof e == 'object' && typeof e.active == 'undefined') {
	  			return;
	  		}

	  		window.opener.__map_editor_callback({
	  			top: e.top,
	  			left: e.left,
	  			width: e.getScaledWidth(),
	  			height: e.getScaledHeight(),
	  			id: location.hash.replace('#', '')
	  		});
		});

		canvas.add(img);

		var opts = {
            left: 100,
            top: 100,
            fill: 'rgba(255,0,0,0.5)',
            width: 200,
            height: 200,
            active: true
        };

        var named_markers = {};

        for (var i = YIM.markers.length - 1; i >= 0; i--) {
        	var m = YIM.markers[i];

        	var r = new fabric.Rect({
        		left: m.posx,
        		top: m.posy,
        		width: m.width,
        		height: m.height,
        		label: m.name,
        		fill: 'rgba(255,0,0,0.2)'
        	});
        	named_markers[m.name] = r;
        	canvas.add(r);
        }

        if(location.hash.substring(0, 5) == '#row-' && !init) {
        	var i = parseInt(location.hash.replace('#row-', ''));
        	if(typeof YIM.markers[i] !== 'undefined') {
        		opts.left = parseFloat(YIM.markers[i].posx);
        		opts.top = parseFloat(YIM.markers[i].posy);
        		opts.width = parseFloat(YIM.markers[i].width);
        		opts.height = parseFloat(YIM.markers[i].height);
        		opts.label = YIM.markers[i].name;


        		if(typeof named_markers[opts.label] !== 'undefined') {
        			canvas.remove(named_markers[opts.label]);
        			canvas.renderAll();
        		}
        	}

        	init = true;	
        }

        var rect = new fabric.Rect(opts);
        opts = false;

        
        canvas.add(rect);
        canvas.renderAll();

		

	
	});


})();