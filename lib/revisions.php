<?php


class HOTEL_Revisions {

    public function __construct() {
        // add_filter( '_wp_post_revision_fields', array($this, 'custom_fields') );
        
        // add_filter( '_wp_post_revision_field_address', array($this, 'address_field'), 10, 2 );
        // add_filter( '_wp_post_revision_field_phone', array($this, 'phone_field'), 10, 2 );
        // add_filter( '_wp_post_revision_field_email', array($this, 'email_field'), 10, 2 );

        add_filter( '_wp_post_revision_fields', array($this, 'hotel_info_fields') );

        add_filter( '_wp_post_revision_field_hotel_info', array($this, 'hotel_info_field'), 10, 2 );
    }

    public function hotel_info_fields( $fields ) {
        $fields['hotel_info'] = 'Hotel Info';

        return $fields;
    }

    public function hotel_info_field( $value, $field ) {
        global $revision;

        return get_metadata( 'post', $revision->ID, $field, true );
    }

    public function custom_fields( $fields ) {
        $fields['address'] = 'Address';
        $fields['phone']   = 'Phone';
        $fields['email']   = 'Email';

        return $fields;
    }

    private function get_field($field) {
        global $revision;

        $meta = get_metadata( 'post', $revision->ID, 'hotel_info', true );

        return $meta[$field];
    }

    public function address_field( $value, $field ) {
        echo $this->get_field($field) . '<br />';
        return $this->get_field($field);
    }

    public function phone_field( $value, $field ) {
        echo $this->get_field($field) . '<br />';
        return $this->get_field($field);
    }

    public function email_field( $value, $field ) {
        echo $this->get_field($field) . '<br />';
        return $this->get_field($field);
    }

}

new HOTEL_Revisions;