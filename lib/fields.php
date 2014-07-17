<?php


class HOTEL_CustomFields {

    public function __construct() {
        add_action( 'init', array($this, 'init') );
    }

    public function init() {
        $this->fm = new Fieldmanager_Group(array(
            'name' => 'hotel_info',

            'children' => array(
                'address' => new Fieldmanager_Textfield('Address'),
                'phone'   => new Fieldmanager_Textfield('Phone'),
                'email'   => new Fieldmanager_Textfield('Email'),
            ),
        ));

        $this->fm->add_meta_box( 'Hotel Information', array( 'hotel' ) );
    }

}

new HOTEL_CustomFields;