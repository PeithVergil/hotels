<?php


class HOTELS_ShortCodes {
    
    public function __construct() {
        // [hotel_list]
        add_shortcode( 'hotel_list', array($this, 'hotel_list') );

        // [hotel_edit]
        add_shortcode( 'hotel_edit', array($this, 'hotel_edit') );
    }

    public function hotel_list( $atts ) {
        $query = new WP_Query(array( 'post_type' => 'hotel' ));

        if ( $query->have_posts() ) { ?>
            <table border="1">
                <thead>
                    <tr>
                        <th><?php _e('Name'); ?></th>
                        <th><?php _e('Address'); ?></th>
                        <th><?php _e('Phone'); ?></th>
                        <th><?php _e('Email'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ( $query->have_posts() ) { $query->the_post();

                        $hotel_info = get_post_meta(get_the_ID(), 'hotel_info', true);

                    ?>
                        <tr>
                            <td>
                                <?php the_title(); ?>
                            </td>
                            <td>
                                <?php echo $hotel_info['address']; ?>
                            </td>
                            <td>
                                <?php echo $hotel_info['phone']; ?>
                            </td>
                            <td>
                                <?php echo $hotel_info['email']; ?>
                            </td>
                            <td>
                                <a href="<?php printf('%s?h=%d', home_url('hotel-edit'), get_the_ID()); ?>"><?php _e('edit'); ?></a>
                            </td>
                        </tr>
                    <?php
                    } // endwhile

                    wp_reset_postdata(); ?>
                </tbody>
            </table>
        <?php
        } else { ?>
            <p><?php _e('No hotel entries.'); ?></p>
        <?php
        } // endif
    }

    public function hotel_edit( $attrs ) {
        $ID = intval($_GET['h']) ? intval($_GET['h']) : -1;

        $query = new WP_Query(array( 'post_type' => 'hotel', 'p' => $ID ));
        
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
                    $form = new HOTEL_HotelEditForm($_POST);

                    if ( $form->valid() ) {
                        $form->submit();
                    }
                } else {
                    $hotel_info = get_post_meta(get_the_ID(), 'hotel_info', true);

                    $form = new HOTEL_HotelEditForm(array(
                        'title'   => get_the_title(),
                        'content' => get_the_content(),
                        'addrs'   => $hotel_info['address'],
                        'phone'   => $hotel_info['phone'],
                        'email'   => $hotel_info['email'],
                    ));
                }

                ?>
                <form method="post">
                    <div>
                        <input type="text" name="title" value="<?php echo esc_attr($form->value('title')); ?>" placeholder="<?php _e('Title'); ?>" />

                        <?php if ( $form->error('title') ) { ?>
                            <p class="text-danger"><?php _e($form->error('title')); ?></p>
                        <?php } // endif ?>
                    </div>
                    <div>
                        <textarea name="content" placeholder="<?php _e('Content'); ?>" rows="12"><?php echo $form->value('content'); ?></textarea>

                        <?php if ( $form->error('content') ) { ?>
                            <p class="text-danger"><?php _e($form->error('content')); ?></p>
                        <?php } // endif ?>
                    </div>
                    <div>
                        <input type="text" name="addrs" value="<?php echo esc_attr($form->value('addrs')); ?>" placeholder="<?php _e('Address'); ?>" />

                        <?php if ( $form->error('addrs') ) { ?>
                            <p class="text-danger"><?php _e($form->error('addrs')); ?></p>
                        <?php } // endif ?>
                    </div>
                    <div>
                        <input type="text" name="phone" value="<?php echo esc_attr($form->value('phone')); ?>" placeholder="<?php _e('Phone'); ?>" />

                        <?php if ( $form->error('phone') ) { ?>
                            <p class="text-danger"><?php _e($form->error('phone')); ?></p>
                        <?php } // endif ?>
                    </div>
                    <div>
                        <input type="text" name="email" value="<?php echo esc_attr($form->value('email')); ?>" placeholder="<?php _e('Email'); ?>" />

                        <?php if ( $form->error('email') ) { ?>
                            <p class="text-danger"><?php _e($form->error('email')); ?></p>
                        <?php } // endif ?>
                    </div>

                    <div>
                        <input type="submit" value="<?php _e('Save Revision'); ?>" />
                    </div>

                    <input type="hidden" name="hotel_id" value="<?php echo $ID; ?>" />
                </form>
            <?php
            } // endwhile

            wp_reset_postdata(); ?>
        <?php
        } else { ?>
            <p><?php _e('No hotel found.'); ?></p>
        <?php
        } // endif
    }

}

new HOTELS_ShortCodes;