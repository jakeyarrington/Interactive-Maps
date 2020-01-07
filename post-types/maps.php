<?php

	function post_type_map() {
		$labels = array(
			'name'					=> _x( 'Maps', 'Map General Name', 'text_domain' ),
			'singular_name'		 	=> _x( 'Map', 'Map Singular Name', 'text_domain' ),
			'menu_name'				=> __( 'Maps', 'text_domain' ),
			'name_admin_bar'		=> __( 'Map', 'text_domain' ),
			'archives'			  	=> __( 'Item Archives', 'text_domain' ),
			'attributes'			=> __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'	 	=> __( 'Parent Item:', 'text_domain' ),
			'all_items'			 	=> __( 'All Items', 'text_domain' ),
			'add_new_item'		  	=> __( 'Add New Item', 'text_domain' ),
			'add_new'			   	=> __( 'Add New', 'text_domain' ),
			'new_item'			  	=> __( 'New Item', 'text_domain' ),
			'edit_item'			 	=> __( 'Edit Item', 'text_domain' ),
			'update_item'		   	=> __( 'Update Item', 'text_domain' ),
			'view_item'			 	=> __( 'View Item', 'text_domain' ),
			'view_items'			=> __( 'View Items', 'text_domain' ),
			'search_items'		  	=> __( 'Search Item', 'text_domain' ),
			'not_found'			 	=> __( 'Not found', 'text_domain' ),
			'not_found_in_trash'	=> __( 'Not found in Trash', 'text_domain' ),
			'featured_image'		=> __( 'Featured Image', 'text_domain' ),
			'set_featured_image'	=> __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'	=> __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'	  	=> __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'			=> __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'	 	=> __( 'Filter items list', 'text_domain' ),
		);

		$args = array(
			'label'				 	=> __( 'Map', 'text_domain' ),
			'description'		   	=> __( 'Map Description', 'text_domain' ),
			'labels'				=> $labels,
			'supports'			  	=> false,
			'hierarchical'		  	=> true,
			'public'				=> false,
			'show_ui'			   	=> true,
			'show_in_menu'		  	=> true,
			'menu_position'		 	=> 5,
			'menu_icon'			 	=> 'dashicons-location',
			'show_in_admin_bar'	 	=> true,
			'show_in_nav_menus'	 	=> true,
			'can_export'			=> true,
			'has_archive'		   	=> true,
			'exclude_from_search'   => false,
			'publicly_queryable'	=> true,
			'capability_type'	   	=> 'post',
			'supports'		   		=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),

		);

		register_post_type( 'map', $args );

	}

	function map_cat_taxonomy() {

		$map_cat_labels = array(
			'name'					   => 'Map Categories',
			'singular_name'			  => 'Map Category',
			'menu_name'				  => 'Map Categories',
			'all_items'				  => 'All Map Categories',
			'parent_item'				=> 'Parent Map Category',
			'parent_item_colon'		  => 'Parent Map Category:',
			'new_item_name'			  => 'New Map Category Name',
			'add_new_item'			   => 'Add New Map Category',
			'edit_item'				  => 'Edit Map Category',
			'update_item'				=> 'Update Map Category',
			'view_item'				  => 'View Item',
			'separate_items_with_commas' => 'Separate Maps with commas',
			'add_or_remove_items'		=> 'Add or remove Maps',
			'choose_from_most_used'	  => 'Choose from the most used Maps',
			'popular_items'			  => 'Popular Items',
			'search_items'			   => 'Search Maps',
			'not_found'				  => 'Not Found',
		);
		$map_cat_args = array(
			'labels'					 => $map_cat_labels,
			'hierarchical'			   => true,
			'public'					 => false,
			'show_ui'					=> true,
			'show_admin_column'		  => true,
			'show_in_nav_menus'		  => true,
			'show_tagcloud'			  => true,
		);

		register_taxonomy( 'map_cat', array( 'map' ), $map_cat_args );

	}

 	add_action( 'init', 'map_cat_taxonomy', 0 );
	add_action( 'init', 'post_type_map', 0 );

?>