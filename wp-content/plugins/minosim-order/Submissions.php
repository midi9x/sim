<?php
class MinoSimOrder
{
    public function __construct()
    {
        add_action('init', array($this, 'add_post_type'));
        add_action('wpcf7_before_send_mail', array($this, 'save_submission'), 999, 2);
    }

    public function add_post_type()
    {
        $labels = array(
            'name'                  => __( 'Đơn hàng', 'Đơn hàng', 'minosim-order' ),
            'singular_name'         => __( 'Đơn hàng', 'Đơn hàng', 'minosim-order' ),
            'menu_name'             => __( 'Đơn hàng', 'minosim-order' ),
            'name_admin_bar'        => __( 'Đơn hàng', 'minosim-order' ),
            'all_items'             => __( 'Đơn hàng', 'minosim-order' ),
            'edit_item'             => __( 'Chi tiết đơn hàng', 'minosim-order' ),
            'update_item'           => __( 'Cập nhật', 'minosim-order' ),
            'view_item'             => __( 'Xem đơn hàng', 'minosim-order' ),
            'view_items'            => __( 'Xem đơn hàng', 'minosim-order' ),
            'search_items'          => __( 'Tìm đơn hàng', 'minosim-order' ),
            'not_found'             => __( 'Not found', 'minosim-order' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'minosim-order' ),
            'items_list'            => __( 'Đơn hàng', 'minosim-order' )
        );
        $args = array(
            'label'               => __('Order', 'minosim-order'),
            'description'         => __('Description', 'minosim-order'),
            'labels'              => $labels,
            'supports'            => false,
            'hierarchical'        => true,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-edit',
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'rewrite'             => false,
            'capability_type'     => 'page',
            'query_var'           => false,
            'capabilities' => array(
                'create_posts'  => false
            ),
            'map_meta_cap' => true
        );
        register_post_type('order', $args);
    }

    public function save_submission($contact_form)
    {
        $submission = WPCF7_Submission::get_instance();
        $data = $submission->get_posted_data();
        $post = array(
            'post_title'    => 'Đặt sim ' . $data['order_number'] . ' từ ' . $data['order_ten'],
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'order',
        );
        $post_id = wp_insert_post($post);
        add_post_meta($post_id, 'order_status', 0);
        add_post_meta($post_id, 'order_number', $data['order_number']);
		add_post_meta($post_id, 'order_price', $data['order_price']);
        add_post_meta($post_id, 'order_time', $data['order_time']);
        add_post_meta($post_id, 'order_ten', $data['order_ten']);
        add_post_meta($post_id, 'order_phone', $data['order_phone']);
        add_post_meta($post_id, 'order_email', $data['order_email']);
        add_post_meta($post_id, 'order_address', $data['order_address']);
        add_post_meta($post_id, 'order_note', $data['order_note']);
        return;
    }
}
