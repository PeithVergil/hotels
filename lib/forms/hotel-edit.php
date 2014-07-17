<?php


class HOTEL_HotelEditForm {

    private $data;

    public $errors;

    public function __construct($data=null) {
        $this->data = $data ? $data : array();

        $this->errors = array();
        $this->result = array();

        $this->clean_title();
        $this->clean_addrs();
        $this->clean_phone();
        $this->clean_email();
    }

    public function valid() {
        return count($this->errors) === 0;
    }

    public function value($field) {
        if ( array_key_exists($field, $this->data) ) {
            return $this->data[$field];
        }

        return null;
    }

    public function error($field) {
        if ( array_key_exists($field, $this->errors) ) {
            return $this->errors[$field];
        }

        return null;
    }

    public function submit() {
        if ( !$this->valid() )
            return;
        
        $ID = intval($this->data['hotel_id']);

        // Create revision
        $rev_id = wp_insert_post(array(
            'post_name'    => "{$ID}-revision",
            'post_type'    => 'revision',
            'post_title'   => $this->data['title'],
            'post_parent'  => $ID,
            'post_status'  => 'inherit',
            'post_content' => $this->data['content']
        ));

        add_metadata('post', $rev_id, 'hotel_info', array(
            'address' => $this->data['addrs'],
            'phone'   => $this->data['phone'],
            'email'   => $this->data['email'],
        ));
    }

    private function clean_title() {
        if ( isset($this->data['title']) && !empty($this->data['title']) ) {
            $this->data['title'] = wp_strip_all_tags( $this->data['title'] );

            return;
        }

        $this->errors['title'] = __('Please enter a title.');
    }

    private function clean_addrs() {
        if ( isset($this->data['addrs']) && !empty($this->data['addrs']) ) {
            $this->data['addrs'] = wp_strip_all_tags( $this->data['addrs'] );

            return;
        }

        $this->errors['addrs'] = __('Please enter an address.');
    }

    private function clean_phone() {
        if ( isset($this->data['phone']) && !empty($this->data['phone']) ) {
            $this->data['phone'] = wp_strip_all_tags( $this->data['phone'] );

            return;
        }

        $this->errors['phone'] = __('Please enter a phone number.');
    }

    private function clean_email() {
        if ( isset($this->data['email']) && !empty($this->data['email']) ) {
            $this->data['email'] = wp_strip_all_tags( $this->data['email'] );

            return;
        }

        $this->errors['email'] = __('Please enter an email address.');
    }

}