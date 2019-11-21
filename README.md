# Interactive-Maps
A WordPress plugin to create fancy, extendable interactive maps.

> This plugin requires Advanced Custom Fields Pro in order to function!

## Introduction
This plugin allows you to quickly and easily create interactive maps from a single image. Using custom markers to plot areas within your maps you can create slick embeddable interactive maps. This plugin has been built using [Fabric.js](http://fabricjs.com/).

## Getting Started
- Install Interactive Maps plugin, ensuring ACF Pro is installed too.
- open "Maps" post type from within the backend of the WordPress site.
- Create a new map, call it "Foo" (or whatever you want).
- Select the map image you wish to use and upload it.
- Click Publish or save it to Draft
- Go to Markers and select "Add Marker".
- Enter the name of the Marker (I'm calling it "Bar"), keep it simple, this name is used when extending.
- Enter the position information or click "Set Position" which will launch an editor window (your popup blocker may prevent this from launching so make sure it isn't being blocked first.)
- Move the red rectangle from the top left of the image and position, scale and resize to fit on the desired location.
- Close the editor window and you should see the position information has been filled in.
- Rinse and repeat until all markers are added.
- All done! You now have your first interactive map!

## Embedding a Map
Using the embed shortcode you can drop a map into any post or page.

```html
/* Change ID to match the ID of your interactive map. */
[yimap width="500" height="500" id="1234"]
```

## Extend Frontend

### Access the Map object in the frontend
```javascript
// We are going to access the map created in the Getting Started section that we named Foo.
var foomap = YIM.map("foo");

// If your map name was "Super Cool Interactive Map", you can call the map as follows:
var custom_map = YIM.map("super-cool-interactive-map");
````

### Access a single Marker
```javascript	
var foomap = YIM.map("foo");

// We're going to access the "Bar" marker as in the Getting Started section.
var bar = foomap.marker("bar");

// If you want to return all marker, simply call the same function without passing an arguemtn.
var all_markers = foomap.marker();
```

### Add Event Handler to Marker
You can see all available event handlers on the [Fabric.js website](https://github.com/fabricjs/fabric.js/wiki/Working-with-events).

```javascript
var foomap = YIM.map("foo");
var bar = foomap.marker("bar");

bar.on("mousedown", function(e) {
	alert("You clicked on BAR!");
});
```

### Modify a Marker
The `marker` function available in this plugin returns a Fabric.js rectangle object and you can modify this as you would if you were modifying a typical Fabric.js shape.

```javascript
var foomap = YIM.map("foo");
var bar = foomap.marker("bar");

bar.set('width', 500);
bar.set({
	height: 500,
	fill: '#f00'
});
	
// Force Fabric.js to render the canvas and update the marker.
foomap.canvas.renderAll();
```

## Extend Backend

### Add Fields to Map
Fields use ACF pro, you can read more about the field types on the [ACF website](https://www.advancedcustomfields.com/resources/). Let's go ahead and add a custom field which will allow us to add custom information in the backend.

```php
add_filter('yim/import/fields', 'add_new_yim_fields');

function add_new_yim_fields($fields) {
	$fields[] = array(
		"key" => "field_map_opacity",
		"name" =>  "opacity",
		"label" => "Opacity",
		"type" => "number",
		"instructions" => "Set the opacity of the map",
		"required" => 0,
		"default_value" => 50
	);
}
```

We can then add this field to the map object.

```php

	add_filter('yim/create/map', 'add_opacity_to_map');

	function add_opacity_to_map($map) {
		$map['opacity'] = intval(get_post_meta($map['ID'], 'opacity')) / 100;

		return $map;
	}
```

Let's have a look at how this look on the frontend.
```javascript
var foomap = YIM.map("foo");
console.log(foomap);

// Outputs
{
	bg: {...},
	canvas: {...},
	config: {
		opacity: 0.5,
		...
	}
	...
}
````

### Add Fields to Markers
Just like above, we can add custom fields to markers.
```php
add_filter('yim/import/field/markers', 'add_waffles_to_markers');

function add_waffles_to_markers($fields) {
	$fields[] = array(
		"key" => "field_marker_has_waffles",
		"name" =>  "has_waffles",
		"label" => "Has Waffles?",
		"type" => "yes_no",
		"instructions" => "Does this marker have waffles?",
		"required" => 0,
		"default_value" => ""
	);
	
	return $fields;
}
```


### Add to Marker Object
We can directly modify the marker on creation, here were going to add an attribute to check if the marker contains waffles.

```php
// We're in the themes functions.php file.

add_filter('yim/create/marker', 'add_waffles_to_marker');

function add_waffles_to_marker($marker) {
	$marker['waffles'] = true;
	
	return $marker;
}
```

Let's have a look at how this looks on the frontend.

```javascript
var foomap = YIM.map("foo");
var bar = foomap.marker("bar");
console.log(bar);

// Outputs
{
	top: 10,
	left: 10,
	$data: {
		id: 1,
		name: "Bar",
		map_ID: 100,
		posx: "10",
		posy: "10",
		width: "100",
		height: "100",
		waffles: true, //This marker does have waffles.
		...
	}
	...
}
```
