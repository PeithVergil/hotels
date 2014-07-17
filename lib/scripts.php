<?php

class HOTELS_Init {
    
    public function __construct() {
        add_action( 'init', array($this, 'init') );

        add_action('wp_enqueue_scripts', array($this, 'styles') );
        add_action('wp_enqueue_scripts', array($this, 'scripts') );
    }
    
    public function init() {
    }

    public function styles() {
        if ( !is_admin() ) {
            //
            // Load custom styles here
            //
        }
    }

    public function scripts() {
        if ( !is_admin() ) {
            //
            // Load custom scripts here
            //
        }
    }
}

new HOTELS_Init;