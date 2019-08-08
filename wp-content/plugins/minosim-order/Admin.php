<?php
class MinoSimOrderAdmin
{
    public function __construct()
    {
        add_filter('manage_order_posts_columns', array($this, 'set_columns'), 999);
        add_action('manage_order_posts_custom_column', array($this, 'column'), 10, 2);
        add_action('manage_posts_extra_tablenav', array($this, 'extra_tablenav'));
        add_action('add_meta_boxes', array($this, 'meta_boxes'), 25);
        add_action('pre_get_posts', array($this, 'set_post_order'));
        add_action('wp', array($this, 'export_request'));
        add_filter('page_row_actions', array($this, 'action_row'), 25, 2);
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
        add_filter('views_edit-order', array($this, 'views'), 999);
        add_filter('gettext', array($this, 'custom_status'), 20, 2);
        add_action('save_post_order', array($this, 'save_order'));
        add_action('admin_head-post.php', array($this, 'hide_publishing_actions'));
        add_action('admin_head-post-new.php', array($this, 'hide_publishing_actions'));
        add_action('post_submitbox_start', array($this, 'actions_meta_box'));
        add_action('restrict_manage_posts', array($this, 'filters'));
        add_action('pre_get_posts', array($this, 'admin_posts'));
    }

    function hide_publishing_actions()
    {
        $post_type = 'order';
        global $post;
        if ($post->post_type == $post_type) {
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                    #major-publishing-actions {
                        background: #fff;
                    }
                    .curtime, .status {
                        margin: 15px 0;
                    }
                </style>
            ';
        }
    }

    /**
     * Replace the default post status
     */
    public function custom_status($translations = '', $text = '')
    {
        global $pagenow, $post_type;
        if ('order' === $post_type && is_admin() && 'edit.php' == $pagenow && 'Published' === $text) {
            $translations = __('Đã đặt ', 'mino-order');
        }
        return $translations;
    }

    /**
     * Change the default post sort
     */
    public function set_post_order($query)
    {
        global $pagenow, $post_type;
        if ('order' === $post_type && is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
    }

    /**
     * Change the default quick post links
     */
    public function views($views)
    {
        if (isset($views['publish'])) {
            $views['publish'] = str_replace(__('Published', 'mino-order'), __('Submitted', 'mino-order'), $views['publish']);
        }
        $keep_views = array('all', 'publish', 'trash');
        // remove others
        foreach (array_keys($views) as $key) {
            if (!in_array($key, $keep_views)) {
                unset($views[$key]);
            }
        }

        return $views;
    }

    /**
     * Enqueue stylesheet
     */
    public function scripts()
    {
        // only enqueue if your on the submissions page
        if ('order' === get_post_type() || (isset($_GET['post_type']) && 'order' === $_GET['post_type'])) {
            wp_enqueue_style('order-style', plugins_url('/css/admin.css', MINOSIM_ORDER_FILE));
        }
    }

    /**
     * Change the post actions
     */
    public function action_row($actions, $post)
    {
        global $post_type;
        if ('order' === $post_type) {
            // remove defaults
            unset($actions['edit']);
            unset($actions['inline hide-if-no-js']);

            $actions = array_merge(array('aview' => '<a href="' . get_edit_post_link($post->ID) . '">'.__('Xem chi tiết', 'mino-order').'</a>'), $actions);
        }
        return $actions;
    }

    /**
     * Change the default table columns
     */
    public function set_columns($columns)
    {
        $columns = array(
            'cb'           => '<input type="checkbox">',
            'order_code'   => __('Mã đơn hàng', 'mino-order'),
            'order_ten'    => __('Họ tên', 'mino-order'),
            'order_number' => __('Số sim', 'mino-order'),
			'order_price' => __('Giá', 'mino-order'),
            'order_status' => __('Trạng thái', 'mino-order')
        );

        $columns['date'] = __('Date', 'mino-order');

        return $columns;
    }

    /**
     * Output values in custom columns
     */
    public function column($column, $post_id)
    {
        switch ($column) {
            case 'order_status':
                $status = $this->getSatatus($post_id);
                echo MINOSIM_ORDER_STATUS[$status];
                break;

			case 'order_price':
            case 'order_ten':
            case 'order_number':
                echo get_post_meta($post_id, $column, true);
                break;

            default:
            ?>
                <a class="row-title" href="<?php echo get_edit_post_link($post_id); ?>">
                    <?php echo get_post_meta($post_id, $column, true); ?>
                </a>
            <?php
                break;
        }
    }

    /**
     * Register custom metaboxes
     */
    public function meta_boxes()
    {
        add_meta_box('order_posted', __('Thông tin đơn hàng', 'mino-order'), array($this, 'posted_meta_box'), 'order', 'normal');

        remove_meta_box( 'submitdiv', 'order', 'side' );

        add_meta_box( 'submitdiv', 'Cập nhật', 'post_submit_meta_box', 'order', 'side', 'high' );

    }

    /**
     * Output for the posted values metabox
     */
    public function posted_meta_box($post)
    {
        $values = $this->get_posted_fields($post->ID); ?>
        <table class="form-table minosim-order">
            <tbody>
                <tr>
                    <th scope="row">Mã đơn hàng</th>
                    <td>
                        <?php echo isset($values['order_code']) ? $values['order_code'][0] : 'Không tồn tại';?>
                    </td>
                </tr>
                <?php foreach ($values as $key => $value) {
                    if ($key == 'order_code') continue;
                    $posted_field = esc_html($value[0]);
                ?>
                    <tr>
                        <th scope="row">
                            <?php echo isset(MINOSIM_ORDER_LABEL[$key]) ? MINOSIM_ORDER_LABEL[$key] : ''; ?>
                        </th>
                        <td>
                            <?php
                                switch ($key) {
                                    case 'order_number':
                                    case 'order_agency_name':
									case 'order_price':
                                        echo $posted_field;
                                        break;
                                    case 'order_note':
                                    case 'order_address':
                            ?>
                                        <textarea class="regular-text" name="<?php echo $key;?>" rows="4" cols="20"><?php echo $posted_field; ?></textarea>
                            <?php
                                        break;
                                    default:
                            ?>
                                        <input type="text" class="regular-text" name="<?php echo $key;?>" value="<?php echo $posted_field; ?>">
                                <?php
                                        break;
                                }
                            ?>
                        </td>
                    </tr>
                <?php
                } ?>
                <tr>
                    <th scope="row">Trạng thái</th>
                    <td>
                        <?php
                            $order_status = $this->getSatatus($post->ID);
                        ?>
                        <select name="order_status" class="regular-text">
                            <?php
                                foreach (MINOSIM_ORDER_STATUS as $key => $value) {
                                    $selected = ($order_status == $key) ? ' selected' : '';
                                    echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php

    }

    /**
     * Output for the actions metabox
     */
    public function actions_meta_box($post)
    {
        if ($post->post_type == 'order') {
            $datef = __('H:i d/m/Y');
            $order_status = $this->getSatatus($post->ID);
            $date = date_i18n($datef, strtotime($post->post_date)); ?>
            <div class="curtime">
                <span id="timestamp"></span> Đặt lúc: <strong><?php echo $date; ?></strong>
            </div>
            <div class="status">
                <span class="misc-pub-post-status"></span>Trạng thái: <strong><?php echo MINOSIM_ORDER_STATUS[$order_status]?></strong>
            </div>
        <?php
        }
    }

    /**
     * Get the posted data for a form
     *
     * @param  integer $post_id the form post ID
     *
     * @return array            the form values
     */
    public function get_posted_fields($post_id = 0)
    {
        $posted = array();
        $post_meta = get_post_meta($post_id);
        $posted = array_intersect_key(
            $post_meta,
            array_flip(array_filter(array_keys($post_meta), function ($key) {
                return preg_match('/^order_/', $key);
            }))
        );

        $posted = apply_filters('order_posted_values', $posted);
        unset($posted['order_agency_id']);
        unset($posted['order_status']);
        return $posted;
    }

    /**
     * Add an export button to the wp-list-table view
     *
     * @param  string $which top or bottom of the table
     *
     */
    public function extra_tablenav()
    {
        $screen = get_current_screen();
        if ('order' === $screen->post_type){
            ?>
            <div class="alignleft actions order-export">
                <button type="submit" name="order-export" value="1" class="button-primary" title="<?php _e('Export the current set of results as CSV', 'mino-order'); ?>"><?php _e('Export to CSV', 'mino-order'); ?></button>
            </div>
            <?php
        }
    }

    /**
     * Handle requests to export all submissions from the admin view
     */
    public function export_request(){
        if(isset($_GET['order-export']) && !empty($_GET['order-export']) && is_admin()) {

            // get charset
            $charset = get_bloginfo( 'charset' );

            // output headers so that the file is downloaded rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=minosim-order.csv');
            header('Content-Transfer-Encoding: binary');

            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');

            // add BOM to fix UTF-8 in Excel
            fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            // use the existing query but get all posts
            global $wp_query;
            $args = array_merge( $wp_query->query_vars, array('posts_per_page' => '-1', 'fields' => 'ids'));
            $submissions = get_posts($args);
            $csv_rows = array();
            $columns = array();
            foreach($submissions as $post_id) {

                $values = $this->get_posted_fields($post_id);

                foreach($values as $key => $value) {
                    // Fix serialize field (select/radio inputs)
                    if(!empty($value)){
                        foreach ($value as &$single){
                            if(is_serialized($single)){
                                $single=implode(', ', unserialize($single));
                            }
                        }
                    }

                    if(is_array($value)){
                        $value = implode(', ', $value);
                    }

                    $value = sanitize_text_field($value);
                    $values[$key] = mb_convert_encoding($value, $charset);

                    // if we havent already stored this column, save it now
                    if(!in_array($key, $columns)){
                        $columns[] = $key;
                    }
                }
                $csv_rows[] = array_merge(array('order_date'=> get_the_date('Y-m-d H:i:s', $post_id)), $values);
            }
            // add default columns
            $pretty_columns = $columns = array_merge( array("order_date"), $columns);
            fputcsv($output,$pretty_columns);

            foreach($csv_rows as $key => $row){
                foreach($columns as $column){
                    $row_values[$column] = $row[$column];
                }
                fputcsv($output,$row_values);
            }

            fclose($output);
            exit();
        }
    }

    function save_order($post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        if ( isset( $_POST['order_status'] ) )
            update_post_meta( $post_id, 'order_status', esc_attr( $_POST['order_status'] ) );
        if ( isset( $_POST['order_number'] ) )
            update_post_meta( $post_id, 'order_number', esc_attr( $_POST['order_number'] ) );
        if ( isset( $_POST['order_ten'] ) )
            update_post_meta( $post_id, 'order_ten', esc_attr( $_POST['order_ten'] ) );
        if ( isset( $_POST['order_phone'] ) )
            update_post_meta( $post_id, 'order_phone', esc_attr( $_POST['order_phone'] ) );
        if ( isset( $_POST['order_email'] ) )
            update_post_meta( $post_id, 'order_email', esc_attr( $_POST['order_email'] ) );
        if ( isset( $_POST['order_address'] ) )
            update_post_meta( $post_id, 'order_address', esc_attr( $_POST['order_address'] ) );
        if ( isset( $_POST['order_note'] ) )
            update_post_meta( $post_id, 'order_note', esc_attr( $_POST['order_note'] ) );
    }

    public function getSatatus($postId)
    {
        $status = get_post_meta($postId, 'order_status', true);
        return ($status == '' && $status === false) ? 0 : (int)$status;
    }

    public function filters()
    {
        global $post_type;
        if ($post_type == 'order') {
        ?>
            <select name="order_status" class="regular-text">
                <option value="">Tất cả trạng thái</option>
                <?php
                    $order_status = isset($_GET['order_status']) ? $_GET['order_status'] : '';
                    foreach (MINOSIM_ORDER_STATUS as $key => $value) {
                        $selected = ($order_status != '' && $order_status == $key) ? ' selected' : '';
                        echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
                    }
                ?>
            </select>
        <?php
        }
    }

    public function admin_posts($query)
    {
        global $post_type;
        if ($query->is_admin && 'order' === $post_type && $query->is_main_query()) {
            if (isset($_GET['order_status']) && $_GET['order_status'] != '') {
                $query->set('meta_query', array(
                    array(
                        'key'     => 'order_status',
                        'value'    => $_GET['order_status'],
                        'compare' => '='
                    )
                ));
            }
        }
    }
}
