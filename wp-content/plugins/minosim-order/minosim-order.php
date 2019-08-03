<?php
/*
Plugin Name: MinoSim Order
Description: Save MinoSim Order From CF7
Version:     1.0.0
Author:      Mino
License:     GPLv3
Domain Path: /languages
Text Domain: minosim-order
*/

define('MINOSIM_ORDER_DIR', realpath(dirname(__FILE__)));
define('MINOSIM_ORDER_FILE', 'minosim-order/minosim-order.php');
define('MINOSIM_ORDER_STATUS', array(
	0 => 'Chưa xác nhận',
	1 => 'Không còn sim',
	2 => 'Đã xác nhận',
	3 => 'Đã hủy',
	4 => 'Hoàn tất'
));

define('MINOSIM_ORDER_LABEL', array(
	'order_number' => 'Số sim',
	'order_price' => 'Giá',
	'order_ten' => 'Họ tên',
	'order_phone' => 'Điện thoại',
	'order_email' => 'Email',
	'order_address' => 'Địa chỉ',
	'order_note' => 'Ghi chú'
));

require_once MINOSIM_ORDER_DIR . '/Submissions.php';
require_once MINOSIM_ORDER_DIR . '/Admin.php';


function minosim_order_init()
{
    global $minosim_order;
    $minosim_order = new MinoSimOrder();
}
add_action('init', 'minosim_order_init', 9);

function minosim_order_admin_init()
{
    global $minosim_order_admin;
    $minosim_order_admin = new MinoSimOrderAdmin();
}
add_action('admin_init', 'minosim_order_admin_init');

/**
 * Load language file
 */
function minosim_order_textdomain()
{
    load_plugin_textdomain('minosim-order', false, basename( dirname( __FILE__ ) ) . '/languages/');

}
add_action('plugins_loaded', 'minosim_order_textdomain');

add_action('admin_menu', 'add_counter_to_order_menu');
function add_counter_to_order_menu()
{
    global $wpdb;
    $query = "SELECT COUNT(*) from $wpdb->posts p 
        INNER JOIN $wpdb->postmeta pm 
        ON p.ID = pm.post_id 
        WHERE pm.meta_key = 'order_status' 
        AND (pm.meta_value = 0 OR pm.meta_value = '') 
        AND p.post_type = 'order'
        AND p.post_status = 'publish' ";
    $count = $wpdb->get_var($query);
    if ($count > 0) {
        global $menu;
        foreach($menu as $key => $value){
            if (isset($value[5]) && $value[5] == 'menu-posts-order') {
                $menu[$key][0] = $menu[$key][0] . ' <span class="update-plugins">' . $count . '</span>';
                break;
            }
        }
    }
}