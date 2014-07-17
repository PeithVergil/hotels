<?php


class HOTELS_PostTypes {
    
    public function __construct() {
        add_action( 'init', array($this, 'hotel') );
    }

    public function hotel() {
        register_post_type('hotel', array(
            'label' => 'Hotels',
            'description' => '',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => array('slug' => 'hotel', 'with_front' => true),
            'query_var' => true,
            'supports' => array('title','editor','revisions'),
            'labels' => array (
                'name' => 'Hotels',
                'singular_name' => 'Hotel',
                'menu_name' => 'Hotels',
                'add_new' => 'Add Hotel',
                'add_new_item' => 'Add New Hotel',
                'edit' => 'Edit',
                'edit_item' => 'Edit Hotel',
                'new_item' => 'New Hotel',
                'view' => 'View Hotel',
                'view_item' => 'View Hotel',
                'search_items' => 'Search Hotels',
                'not_found' => 'No Hotels Found',
                'not_found_in_trash' => 'No Hotels Found in Trash',
                'parent' => 'Parent Hotel',
            )
        ));
    }

}

new HOTELS_PostTypes;