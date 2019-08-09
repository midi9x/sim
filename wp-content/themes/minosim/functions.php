<?php

/**
 * MinoSim functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MinoSim
 */

if ( ! function_exists( 'minosim_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function minosim_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on MinoSim, use a find and replace
     * to change 'minosim' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'minosim', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'minosim' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'minosim_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'minosim_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minosim_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'minosim_content_width', 640 );
}
add_action( 'after_setup_theme', 'minosim_content_width', 0 );


/**
 * Add CSS/JS Scritps
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Register Widget Areas
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Bootstrap Walker.
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

include 'config.php';

add_filter('use_block_editor_for_post', '__return_false');

function sim_post_type() {

    $labels = array(
        'name'                  => _x( 'Sim', 'Post Type General Name', 'minosim' ),
        'singular_name'         => _x( 'Sim', 'Post Type Singular Name', 'minosim' ),
        'menu_name'             => __( 'Quản lý sim', 'minosim' ),
        'name_admin_bar'        => __( 'Sim', 'minosim' ),
        'archives'              => __( 'Lưu trữ', 'minosim' ),
        'all_items'             => __( 'Tất cả sim', 'minosim' ),
        'add_new_item'          => __( 'Thêm mới', 'minosim' ),
        'add_new'               => __( 'Thêm mới', 'minosim' ),
        'new_item'              => __( 'Thêm mới', 'minosim' ),
        'edit_item'             => __( 'Sửa', 'minosim' ),
        'update_item'           => __( 'Cập nhật', 'minosim' ),
        'view_item'             => __( 'Xem', 'minosim' ),
        'view_items'            => __( 'Xem', 'minosim' ),
        'search_items'          => __( 'Tìm kiếm', 'minosim' ),
        'not_found'             => __( 'Không tồn tại', 'minosim' ),
        'not_found_in_trash'    => __( 'Không tồn tại', 'minosim' ),
        'items_list'            => __( 'Danh sách sim', 'minosim' ),
        'items_list_navigation' => __( 'Danh sách sim', 'minosim' ),
        'filter_items_list'     => __( 'Lọc', 'minosim' ),
    );
    $args = array(
        'label'                 => __( 'Sim', 'minosim' ),
        'description'           => __( 'Quản lý Sim', 'minosim' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'agency' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-editor-kitchensink',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'capabilities'          => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap' => true
    );
    register_post_type( 'sim', $args );

}
add_action( 'init', 'sim_post_type', 0 );

function custom_agency() {

    $labels = array(
        'name'                       => _x( 'Đại lý', 'Taxonomy General Name', 'minosim' ),
        'singular_name'              => _x( 'Đại lý', 'Taxonomy Singular Name', 'minosim' ),
        'menu_name'                  => __( 'Đại lý', 'minosim' ),
        'all_items'                  => __( 'Tất cả đại lý', 'minosim' ),
        'parent_item'                => __( 'Parent Item', 'minosim' ),
        'parent_item_colon'          => __( 'Parent Item:', 'minosim' ),
        'new_item_name'              => __( 'Thêm mới đại lý', 'minosim' ),
        'add_new_item'               => __( 'Thêm mới đại lý', 'minosim' ),
        'edit_item'                  => __( 'Sửa đại lý', 'minosim' ),
        'update_item'                => __( 'Cập nhật đại lý', 'minosim' ),
        'view_item'                  => __( 'Xem đại lý', 'minosim' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'minosim' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'minosim' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'minosim' ),
        'popular_items'              => __( 'Popular Items', 'minosim' ),
        'search_items'               => __( 'Search Items', 'minosim' ),
        'not_found'                  => __( 'Not Found', 'minosim' ),
        'no_terms'                   => __( 'No items', 'minosim' ),
        'items_list'                 => __( 'Items list', 'minosim' ),
        'items_list_navigation'      => __( 'Items list navigation', 'minosim' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical' => false,
        'parent_item'  => null,
        'parent_item_colon' => null,
        'public'                     => false,
        'show_ui'                    => true,
        'show_admin_column'          => false,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'agency', array( 'sim' ), $args );

}
add_action( 'init', 'custom_agency', 0 );

// sim column
add_filter('manage_sim_posts_columns', 'set_columns', 999);
add_action('manage_sim_posts_custom_column', 'column', 10, 2);

function set_columns($columns)
{
    $columns = [
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'price' => __('Giá', 'minosim'),
        'agency' => __('Đại lý', 'minosim'),
        'date' => $columns['date'],
        'wpseo-links' => $columns['wpseo-links'],
        'wpseo-score' => $columns['wpseo-score'],
        'wpseo-score-readability' => $columns['wpseo-score-readability'],
        'wpseo-title' => $columns['wpseo-title'],
        'wpseo-metadesc' => $columns['wpseo-metadesc'],
        'wpseo-focuskw' => $columns['wpseo-focuskw'],
    ];
    return $columns;
}

function getAgency($agencyID) {
    $term = get_term( $agencyID, 'agency' );
    if (!empty($term)) {
        return $term->name;
    } else {
        return 'Không có';
    }
}

function column($column, $post_id)
{
    switch ($column) {
        case 'price':
            echo getGia($post_id);
            break;

        case 'agency':
            $agency = get_post_field('agency', $post_id);
            echo getAgency($agency);
            break;
        default:
            break;
    }
}

// agency column
function agency_taxonomy_columns( $columns )
{
    unset($columns['posts']);
    $columns['count'] = __('Tổng sim');
    return $columns;
}
add_filter('manage_edit-agency_columns' , 'agency_taxonomy_columns');

function agency_taxonomy_columns_content( $content, $column_name, $term_id )
{
    if ( 'count' == $column_name ) {
        global $wpdb;
        $simCount = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts where post_type = 'sim' and agency = $term_id" );
        $content = $simCount ;
    }
    return $content;
}
add_filter( 'manage_agency_custom_column', 'agency_taxonomy_columns_content', 10, 3 );

//delete agency
function action_delete_agency( $term, $tt_id, $deleted_term, $object_ids ) {
    global $wpdb;
    $queryDelete = "DELETE p
        FROM $wpdb->posts p
        WHERE post_type = 'sim'
        AND agency = $tt_id";
    $wpdb->query($queryDelete);
    $wpdb->flush();
    return;
}
add_action( "delete_agency", 'action_delete_agency', 10, 4 );

// Hide slug
function remove_slug_form() {
    echo "<style>.form-field.term-slug-wrap{display:none;}</style>";
}
add_action( "agency_edit_form", 'remove_slug_form');
add_action( "agency_add_form", 'remove_slug_form');

add_filter('manage_edit-agency_columns', function ( $columns )
{
    if( isset( $columns['slug'] ) )
        unset( $columns['slug'] );

    return $columns;
} );

// end

function get_search_sim_form()
{
    ob_start();
    require('searchsimform.php');
    $form = ob_get_clean();
    echo $form;
}

function get_filter_sim_form()
{
    ob_start();
    require('filtersimform.php');
    $form = ob_get_clean();
    echo $form;
}


function get_search_sim_query()
{
    if (is_page('tim-sim')) {
        $keyword = get_query_var('keyword');
        return $keyword;
    }
    return;
}


function wpbs_pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2) + 1;
    global $paged;
    if(empty($paged)) {
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    }
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;

        if(!$pages)
            $pages = 1;
    }

    if(1 != $pages) {
        echo '<nav aria-label="Page navigation" role="navigation">';
        echo '<span class="sr-only">Page navigation</span>';
        echo '<ul class="pagination justify-content-center ft-wpbs">';

        //echo '<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">Page '.$paged.' of '.$pages.'</span></li>';

        if($paged > 2 && $paged > $range+1 && $showitems < $pages)
            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page">&laquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';

        if($paged > 1 && $showitems < $pages)
            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged - 1).'" aria-label="Previous Page">&lsaquo;<span class="hidden-sm-down d-none d-md-block"></span></a></li>';

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                echo ($paged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
        }

        if ($paged < $pages && $showitems < $pages)
            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged + 1).'" aria-label="Next Page"><span class="hidden-sm-down d-none d-md-block"></span>&rsaquo;</a></li>';

        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page"><span class="hidden-sm-down d-none d-md-block"></span>&raquo;</a></li>';

        echo '</ul>';
        echo '</nav>';
    }
}

add_filter( 'init', 'add_query_var' );
function add_query_var()
{
    global $wp;
    $wp->add_query_var( 'keyword' );
    $wp->add_query_var( 'simnumber' );
}

function custom_rewrite_url() {
    add_rewrite_rule( 'tim-sim/([0-9*]+)/page/([0-9]{1,})/?', 'index.php?page_id=88&keyword=$matches[1]&paged=$matches[2]', 'top' );
    add_rewrite_rule( 'tim-sim/([0-9*]+)/?', 'index.php?page_id=88&keyword=$matches[1]', 'top' );
    add_rewrite_rule( 'y-nghia-sim-([0-9]{10})/?$', 'index.php?page_id=17717&simnumber=$matches[1]', 'top' );
}
add_action('init', 'custom_rewrite_url');

add_filter( 'posts_where', 'sim_posts_where', 10, 2 );

function sim_posts_where( $where, $wp_query )
{
    if ($timsim = $wp_query->get('timsim' )) {
        $where .= $timsim;
    }
    return $where;
}

function gp_remove_cpt_slug( $post_link, $post ) {
    if ( 'sim' === $post->post_type && 'publish' === $post->post_status ) {
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}

//remove sim slug
add_filter( 'post_type_link', 'gp_remove_cpt_slug', 10, 2 );
function gp_add_cpt_post_names_to_main_query( $query ) {
    // Bail if this is not the main query.
    if ( ! $query->is_main_query() ) {
        return;
    }
    // Bail if this query doesn't match our very specific rewrite rule.
    if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
        return;
    }
    // Bail if we're not querying based on the post name.
    if ( empty( $query->query['name'] ) ) {
        return;
    }
    // Add CPT to the list of post types WP will include when it queries based on the post name.
    $query->set( 'post_type', array( 'post', 'page', 'sim' ) );
}
add_action( 'pre_get_posts', 'gp_add_cpt_post_names_to_main_query' );

// add meta box

function thong_tin_sim_get_meta( $value ) {
    global $post;

    return get_post_field( $value, $post->ID );
}

function thong_tin_sim_add_meta_box() {
    add_meta_box(
        'thong_tin_sim-thong-tin-sim',
        __( 'Thông tin sim', 'thong_tin_sim' ),
        'thong_tin_sim_html',
        'sim',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'thong_tin_sim_add_meta_box' );

function thong_tin_sim_html( $post) {
    wp_nonce_field( '_thong_tin_sim_nonce', 'thong_tin_sim_nonce' ); ?>

    <p>
        <label for="price"><?php _e( 'Giá sim:', 'thong_tin_sim' ); ?></label><br>
        <input type="number" name="price" id="price" value="<?php echo thong_tin_sim_get_meta( 'price' ); ?>" required>
    </p>
    <p>
        <label for="price"><?php _e( 'Đại lý:', 'thong_tin_sim' ); ?></label><br>
        <select name="agency" id="agency" required>
            <option value="">--Chọn đại lý--</option>
            <?php
                $agencies = get_terms( array(
                    'taxonomy' => 'agency',
                    'hide_empty' => false,
                ));
                foreach ($agencies as $key => $agency) {
                    $selected = (thong_tin_sim_get_meta( 'agency' ) == $agency->term_id) ? ' selected' : '';
                    echo '<option ' . $selected . ' value="' . $agency->term_id . '">' . $agency->name . '</option>';
                }
            ?>
        </select>
    </p><?php
}

function thong_tin_sim_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['thong_tin_sim_nonce'] ) || ! wp_verify_nonce( $_POST['thong_tin_sim_nonce'], '_thong_tin_sim_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    global $wpdb;
    if ( isset( $_POST['price'] ) ) {
        $wpdb->update( $wpdb->posts, array( 'price' => $_POST['price'] ), array( 'ID' => $post_id ) );
    }
    if ( isset( $_POST['agency'] ) ) {
        $wpdb->update( $wpdb->posts, array( 'agency' => $_POST['agency'] ), array( 'ID' => $post_id ) );
    }
    $wpdb->flush();
}
add_action( 'save_post', 'thong_tin_sim_save');

/*
    Usage: thong_tin_sim_get_meta( 'price' )
*/

/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function thong_tin_trang_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function thong_tin_trang_add_meta_box() {
    add_meta_box(
        'thong_tin_trang-thong-tin-trang',
        __( 'Thông tin trang', 'thong_tin_trang' ),
        'thong_tin_trang_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'thong_tin_trang_add_meta_box' );

function thong_tin_trang_html( $post) {
    wp_nonce_field( '_thong_tin_trang_nonce', 'thong_tin_trang_nonce' ); ?>
    <p>
        <label for="nhamang"><?php _e( 'Nhà mạng', 'thong_tin_trang' ); ?></label><br>
        <select name="nhamang" id="nhamang">
            <option></option>
            <option value="viettel" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'viettel' ) ? 'selected' : '' ?>>Viettel</option>
            <option value="mobifone" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'mobifone' ) ? 'selected' : '' ?>>Mobifone</option>
            <option value="vinaphone" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'vinaphone' ) ? 'selected' : '' ?>>Vinaphone</option>
            <option value="vietnamobile" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'vietnamobile' ) ? 'selected' : '' ?>>Vietnamobile</option>
            <option value="gmobile" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'gmobile' ) ? 'selected' : '' ?>>Gmobile</option>
            <option value="itelecom" <?php echo (thong_tin_trang_get_meta( 'nhamang' ) === 'itelecom' ) ? 'selected' : '' ?>>iTelecom</option>
        </select>
    </p>
    <p>
        <label for="mucgia"><?php _e( 'Giá từ', 'thong_tin_trang' ); ?></label><br>
        <input type="text" name="giatu" id="giatu" value="<?php echo thong_tin_trang_get_meta( 'giatu' ); ?>">
    </p>
    <p>
        <label for="mucgia"><?php _e( 'Giá đến', 'thong_tin_trang' ); ?></label><br>
        <input type="text" name="giaden" id="giaden" value="<?php echo thong_tin_trang_get_meta( 'giaden' ); ?>">
    </p>
    <p>
        <label for="dauso"><?php _e( 'Đầu số', 'thong_tin_trang' ); ?></label><br>
        <input type="text" name="dauso" id="dauso" value="<?php echo thong_tin_trang_get_meta( 'dauso' ); ?>">
    </p>
    <p>
        <label for="duoiso"><?php _e( 'Đuôi số', 'thong_tin_trang' ); ?></label><br>
        <input type="text" name="duoiso" id="duoiso" value="<?php echo thong_tin_trang_get_meta( 'duoiso' ); ?>">
    </p>
    <p>
        <label for="loaisim"><?php _e( 'Loại sim', 'thong_tin_trang' ); ?></label><br>
        <select name="loaisim" id="loaisim">
            <option></option>
            <option value="sim-tu-quy" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-tu-quy' ) ? 'selected' : '' ?>>Sim Tứ Quý</option>
            <option value="sim-luc-quy" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-luc-quy' ) ? 'selected' : '' ?>>Sim Lục Quý</option>
            <option value="sim-ngu-quy" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-ngu-quy' ) ? 'selected' : '' ?>>Sim Ngũ Quý</option>
            <option value="sim-loc-phat" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-loc-phat' ) ? 'selected' : '' ?>>Sim Lộc Phát</option>
            <option value="sim-than-tai" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-than-tai' ) ? 'selected' : '' ?>>Sim Thần Tài</option>
            <option value="sim-ong-dia" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-ong-dia' ) ? 'selected' : '' ?>>Sim ông địa</option>
            <option value="sim-tien-don" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-tien-don' ) ? 'selected' : '' ?>>Sim tiến đơn</option>
            <option value="sim-tien-doi" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-tien-doi' ) ? 'selected' : '' ?>>Sim Tiến đôi</option>
            <option value="sim-taxi-hai" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-taxi-hai' ) ? 'selected' : '' ?>>Sim Taxi 2</option>
            <option value="sim-taxi-ba" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-taxi-ba' ) ? 'selected' : '' ?>>Sim Taxi 3</option>
            <option value="sim-taxi-bon" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-taxi-bon' ) ? 'selected' : '' ?>>Sim Taxi 4</option>
            <option value="sim-lap" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-lap' ) ? 'selected' : '' ?>>Sim Lặp</option>
            <option value="sim-kep" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-kep' ) ? 'selected' : '' ?>>Sim kép</option>
            <option value="sim-doi" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-doi' ) ? 'selected' : '' ?>>Sim đối</option>
            <option value="sim-dao" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-dao' ) ? 'selected' : '' ?>>Sim Đảo</option>
            <option value="sim-ganh" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-ganh' ) ? 'selected' : '' ?>>Sim gánh</option>
            <option value="sim-dac-biet" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-dac-biet' ) ? 'selected' : '' ?>>Sim Đặc Biệt</option>
            <option value="sim-nam-sinh" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'sim-nam-sinh' ) ? 'selected' : '' ?>>Sim Năm Sinh</option>
            <option value="dau-so-co" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'dau-so-co' ) ? 'selected' : '' ?>>Sim đầu số cổ</option>
            <option value="tam-hoa-don" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'tam-hoa-don' ) ? 'selected' : '' ?>>Sim tam Hoa Đơn</option>
            <option value="tam-hoa-kep" <?php echo (thong_tin_trang_get_meta( 'loaisim' ) === 'tam-hoa-kep' ) ? 'selected' : '' ?>>Sim tam Hoa Kép</option>
        </select>
    </p>
    <?php
}

function thong_tin_trang_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['thong_tin_trang_nonce'] ) || ! wp_verify_nonce( $_POST['thong_tin_trang_nonce'], '_thong_tin_trang_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['giatu'] ) )
        update_post_meta( $post_id, 'giatu', esc_attr( $_POST['giatu'] ) );
    if ( isset( $_POST['giaden'] ) )
        update_post_meta( $post_id, 'giaden', esc_attr( $_POST['giaden'] ) );
    if ( isset( $_POST['dauso'] ) )
        update_post_meta( $post_id, 'dauso', esc_attr( $_POST['dauso'] ) );
    if ( isset( $_POST['duoiso'] ) )
        update_post_meta( $post_id, 'duoiso', esc_attr( $_POST['duoiso'] ) );
    if ( isset( $_POST['loaisim'] ) )
        update_post_meta( $post_id, 'loaisim', esc_attr( $_POST['loaisim'] ) );
    if ( isset( $_POST['nhamang'] ) )
        update_post_meta( $post_id, 'nhamang', esc_attr( $_POST['nhamang'] ) );
}
add_action( 'save_post', 'thong_tin_trang_save' );

/*
    Usage: thong_tin_trang_get_meta( 'mucgia' )
    Usage: thong_tin_trang_get_meta( 'dauso' )
    Usage: thong_tin_trang_get_meta( 'duoiso' )
*/

function custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );
function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_number = 'order_number';
    $my_time = 'order_code';
    $my_price = 'order_price';
    $my_agency_id= 'order_agency_id';
    $my_agency_name= 'order_agency_name';

    if ( isset( $atts[$my_time] ) ) {
        $out[$my_time] = time();
    }
    if ( isset( $atts[$my_number] ) ) {
        $out[$my_number] = $atts[$my_number];
    }
    if ( isset( $atts[$my_price] ) ) {
        $out[$my_price] = $atts[$my_price];
    }
    if ( isset( $atts[$my_agency_id] ) ) {
        $out[$my_agency_id] = $atts[$my_agency_id];
    }
    if ( isset( $atts[$my_agency_name] ) ) {
        $out[$my_agency_name] = $atts[$my_agency_name];
    }
    return $out;
}

// Register status sold
function custom_sim_status() {

    $args = array(
        'label'                     => _x( 'Đã bán', 'Đã bán', 'minosim' ),
        'label_count'               => _n_noop( 'Đã bán <span class="count">(%s)</span>',  '<span class="count">Đã bán (%s)</span>', 'minosim' ),
        'public'                    => true,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'exclude_from_search'       => false,
    );
    register_post_status( 'sold', $args );

}
add_action( 'init', 'custom_sim_status', 0 );
function my_custom_status_add_in_quick_edit() {
    echo "<script>
    jQuery(document).ready( function() {
        jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"sold\">Đã bán</option>' );
    });
    </script>";
}
add_action('admin_footer-edit.php','my_custom_status_add_in_quick_edit');
function my_custom_status_add_in_post_page() {
    echo "<script>
    jQuery(document).ready( function() {
        jQuery( 'select[name=\"post_status\"]' ).append( '<option value=\"sold\">Đã bán</option>' );
    });
    </script>";
}
add_action('admin_footer-post.php', 'my_custom_status_add_in_post_page');
add_action('admin_footer-post-new.php', 'my_custom_status_add_in_post_page');

// End status sold

// thêm sim
add_action('admin_menu', 'add_submenu');
function add_submenu() {
    add_submenu_page( 'edit.php?post_type=sim', 'Thêm sim', 'Thêm sim', 'manage_options', 'add_sim', 'add_sim' );
    add_submenu_page( 'edit.php?post_type=sim', 'Cập nhật sim', 'Cập nhật sim', 'manage_options', 'update_sim', 'update_sim' );
    add_submenu_page( 'edit.php?post_type=sim', 'Xóa sim', 'Xóa sim', 'manage_options', 'delete_sim', 'delete_sim' );
}
function add_sim() {
?>
    <h1 class="wp-heading-inline">Thêm sim</h1>
    <form id="formAddSim">
        <table class="widefat" style="border-radius:4px;">
            <tbody>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Nhập sim:<br><span style="color: red">(Tối đa khoảng 100k số)</span></td>
                    <td colspan="2" style="padding:8px 12px;">
                        <textarea style="width:100%;border-radius:4px;" name="sim" id="sim" rows="8" placeholder="Copy 2 cột SỐ và GIÁ trong excel rồi paste vào đây &#10;Ví dụ: &#10;0999.999.999 100,000,000,000&#10;0999.999.998 90,000,000,000" required></textarea>
                    </td>
                </tr>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Đại lý:</td>
                    <td colspan="2" style="padding:20px 12px;">
                        <select name="agency" id="agency" required>
                            <option value="">--Chọn đại lý--</option>
                            <?php
                                $get = '';
                                if (isset($_GET['agency'])) $get = $_GET['agency'];

                                $agencies = get_terms( array(
                                    'taxonomy' => 'agency',
                                    'hide_empty' => false,
                                ));
                                foreach ($agencies as $key => $agency) {
                                    $selected = ($get == $agency->term_id) ? ' selected' : '';
                                    echo '<option ' . $selected . ' value="' . $agency->term_id . '">' . $agency->name . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Định dạng giá:</td>
                    <td colspan="2" style="padding:20px 12px;">
                        <label><input type="radio" name="gia" value="1" checked required> Tiêu chuẩn (1.000.000 = 1tr)</label>
                        <label><input type="radio" name="gia" value="2" required> Viết tắt (1.000 = 1tr)</label>
                        <label><input type="radio" name="gia" value="3" required> Viết tắt (1 = 1tr)</label>
                    </td>
                </tr>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Cài đặt khác:</td>
                    <td colspan="2" style="padding:20px 12px;">
                        <label><input type="radio" name="setting" value="1" checked> Xóa số cũ, đăng số mới</label>
                        <label><input type="radio" name="setting" value="2"> Đăng thêm số mới</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="wp-core-ui">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Thêm sim">
                        <input type="reset" class="button" value="Làm lại">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="modal"></div>
    <style type="text/css">
        .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
                        url('https://i.stack.imgur.com/FhHRx.gif')
                        50% 50%
                        no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $body = $("body");
            jQuery('#formAddSim').on('submit', function(event) {
                event.preventDefault();
                $body.addClass("loading");
                var sim = $('#sim').val();
                var agency = $('#agency').val();
                var gia = $('input[name=gia]:checked').val();
                var setting = $('input[name=setting]:checked').val();
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'add_sim_ajax',
                        sim: sim,
                        agency: agency,
                        gia: gia,
                        setting: setting
                    },
                    success: function(data) {
                        $body.removeClass("loading");
                        data = JSON.parse(data);
                        var message = "Hoàn thành!\n"
                        if (data.delete >= 0) message+= "- Xóa: " + data.delete + " số\n"
                        if (data.add >= 0) message+= "- Thêm mới: " + data.add + " số\n"
                        if (data.error >= 0) message+= "- Lỗi: " + data.error + " số\n"
                        alert(message);
                    },
                    error: function() {
                        $body.removeClass("loading");
                        alert('Có lỗi xảy ra, vui lòng làm mới trang web!');
                        // window.location.reload();
                    }
                });
            });
        });
    </script>
<?php
}
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('post_max_size', '512MB');*/
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
add_action( 'wp_ajax_add_sim_ajax', 'add_sim_ajax' );
add_action( 'wp_ajax_nopriv_add_sim_ajax', 'add_sim_ajax' );
function add_sim_ajax() {
    $response = [
        'delete' => 0,
        'add' => 0,
        'error' => 0
    ];

    if (!isset($_POST['sim']) || !isset($_POST['agency']) || !isset($_POST['gia']) || !isset($_POST['setting'])) {
        echo json_encode($response);
        exit;
    }

    $sim = $_POST['sim'];
    $agency = (int)$_POST['agency'];
    $gia = $_POST['gia'];
    $setting = $_POST['setting'];

    global $wpdb;
    if ($setting == 1) {
        // delele old sim
        $queryDelete = "DELETE p
            FROM $wpdb->posts p
            WHERE post_type = 'sim'
            AND agency = $agency";
        $countDeleted = $wpdb->query($queryDelete);
        $response['delete'] = $countDeleted;
    }
    $simArr = explode(PHP_EOL, $sim);
    $valueSim = '';
    $totalSimArr = count($simArr);
    $authorId = get_current_user_id();
    $time = date('Y-m-d h:i:s');
    foreach ($simArr as $key => $simso) {
        $simso = trim($simso);
        // split by space or tab
        $simso = preg_split('/\s+/', $simso);
        $simso = array_filter($simso);
        if (count($simso) != 2) {
            $response['error'] = $response['error'] + 1;
            continue;
        }

        $sso = $simso[0];
        // $sso = str_replace('"', "", $sso);
        // $sso = str_replace("'", "", $sso);
        // $sso = str_replace("\/", "", $sso);
        // $sso = str_replace("\\", "", $sso);
        $sso = preg_replace('/^[\p{Z}\s]+|[\p{Z}\s]+$/u','',$sso);
        $sso = trim($sso, '.,-');

        $sgia = remove_character($simso[1]);

        switch ($gia) {
            case 2:
                $sgia = $sgia . '000';
                break;

            case 3:
                $sgia = $sgia . '000000';
                break;

            default:
                $sgia = $sgia;
                break;
        }
        $slug = remove_character($sso);
        if (strlen($slug) == 9) {
            $slug = '0' . $slug;
            $sso = '0' . $sso;
        }
        if (strlen($slug) != 10) {
            $response['error'] = $response['error'] + 1;
            continue;
        }
        $valueSim .= "('$sso', '','','','','', '$slug', 'sim', 'publish', $sgia, $agency, $authorId, '$time', '$time', '$time', '$time', 'closed', 'closed'),";
    }
    if ($valueSim) {
        $valueSim = substr($valueSim, 0, -1);
        $queryInsert = "INSERT INTO $wpdb->posts(post_title, post_content, post_excerpt, to_ping, pinged, post_content_filtered, post_name, post_type, post_status, price, agency, post_author, post_date, post_date_gmt, post_modified, post_modified_gmt, comment_status, ping_status) VALUES $valueSim";
        $countInsert = $wpdb->query($queryInsert);
        $response['add'] = (int) $countInsert;
    }
    $wpdb->flush();
    echo json_encode($response);
    exit;
}

// update sim
function update_sim() {
?>
    <h1 class="wp-heading-inline">Cập nhật sim</h1>
    <form id="formUpdateSim">
        <table class="widefat" style="border-radius:4px;">
            <tbody>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Nhập sim:</td>
                    <td colspan="2" style="padding:8px 12px;">
                        <textarea style="width:100%;border-radius:4px;" name="sim" id="sim" rows="8" placeholder="Mỗi sim 1 dòng&#10;Ví dụ: &#10;0999.999.999&#10;0999.999.998" required></textarea>
                    </td>
                </tr>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Cài đặt:</td>
                    <td colspan="2" style="padding:20px 12px;">
                        <label><input type="radio" name="update_action" value="1" checked required> Số đã bán</label>
                        <label><input type="radio" name="update_action" value="2" required> Giá liên hệ</label>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="wp-core-ui">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Cập nhật sim">
                        <input type="reset" class="button" value="Làm lại">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="modal"></div>
    <style type="text/css">
        .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
                        url('https://i.stack.imgur.com/FhHRx.gif')
                        50% 50%
                        no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $body = $("body");
            jQuery('#formUpdateSim').on('submit', function(event) {
                event.preventDefault();
                $body.addClass("loading");
                var sim = $('#sim').val();
                var update_action = $('input[name=update_action]:checked').val();
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'update_sim_ajax',
                        sim: sim,
                        update_action: update_action
                    },
                    success: function(data) {
                        $body.removeClass("loading");
                        data = JSON.parse(data);
                        var message = "Hoàn thành!\n";
                        message+= "- Cập nhật: " + data.update + " số\n";
                        alert(message);
                    },
                    error: function() {
                        $body.removeClass("loading");
                        alert('Có lỗi xảy ra, vui lòng làm mới trang web!');
                        window.location.reload();
                    }
                });
            });
        });
    </script>
<?php
}

add_action( 'wp_ajax_update_sim_ajax', 'update_sim_ajax' );
add_action( 'wp_ajax_nopriv_update_sim_ajax', 'update_sim_ajax' );

function update_sim_ajax() {
    $response = [
        'update' => 0
    ];

    if (!isset($_POST['sim'])|| !isset($_POST['update_action'])) {
        echo json_encode($response);
        exit;
    }
    $sim = $_POST['sim'];
    $update_action = $_POST['update_action'];

    $input_sim = explode(PHP_EOL, $sim);

    global $wpdb;
    $arraySim = array();
    foreach ($input_sim as $key => $simso) {
        $simso = remove_character($simso);
        $arraySim[] = $simso;
    }
    $arraySim = array_filter($arraySim);
    $stringSo = "(" . implode(',', $arraySim) . ")";

    $query = '';
    switch ($update_action) {
        case 1:
            $query = "UPDATE $wpdb->posts p
                SET p.post_status = 'sold'
                WHERE p.post_name in $stringSo";
            break;

        case 2:
            $query = "UPDATE $wpdb->posts p
                SET p.price = 0
                WHERE p.post_name in $stringSo";
            break;

        default:
            break;
    }
    if ($query) {
        $countAffected = $wpdb->query($query);
        $response['update'] = $countAffected;
    }
    $wpdb->flush();
    echo json_encode($response);
    exit;
}

//delete sim

function delete_sim() {
?>
    <h1 class="wp-heading-inline">Xóa sim</h1>
    <form id="formDeleteSim">
        <table class="widefat" style="border-radius:4px;">
            <tbody>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Xóa theo số sim:</td>
                    <td colspan="2" style="padding:8px 12px;">
                        <textarea style="width:100%;border-radius:4px;" name="sim" id="sim" rows="8" placeholder="Mỗi sim 1 dòng&#10;Ví dụ: &#10;0999.999.999&#10;0999.999.998"></textarea>
                    </td>
                </tr>
                <tr class="alternate iedit">
                    <td valign="top" style="width:180px;font-weight:600;font-size:14px;padding: 20px 10px;">Xóa sim theo đại lý:</td>
                    <td colspan="2" style="padding:20px 12px;">
                        <select name="agency" id="agency">
                            <option value="">--Chọn đại lý--</option>
                            <?php
                                $get = '';
                                if (isset($_GET['agency'])) $get = $_GET['agency'];

                                $agencies = get_terms( array(
                                    'taxonomy' => 'agency',
                                    'hide_empty' => false,
                                ));
                                foreach ($agencies as $key => $agency) {
                                    $selected = ($get == $agency->term_id) ? ' selected' : '';
                                    echo '<option ' . $selected . ' value="' . $agency->term_id . '">' . $agency->name . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="wp-core-ui">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Xóa sim">
                        <input type="reset" class="button" value="Làm lại">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="modal"></div>
    <style type="text/css">
        .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
                        url('https://i.stack.imgur.com/FhHRx.gif')
                        50% 50%
                        no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $body = $("body");
            jQuery('#formDeleteSim').on('submit', function(event) {
                event.preventDefault();
                $body.addClass("loading");
                var sim = $('#sim').val();
                var agency = $('#agency').val();
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'delete_sim_ajax',
                        sim: sim,
                        agency: agency
                    },
                    success: function(data) {
                        $body.removeClass("loading");
                        data = JSON.parse(data);
                        var message = "Hoàn thành!\n";
                        message+= "- Xóa: " + data.delete + " số\n";
                        alert(message);
                    },
                    error: function() {
                        $body.removeClass("loading");
                        alert('Có lỗi xảy ra, vui lòng làm mới trang web!');
                        window.location.reload();
                    }
                });
            });
        });
    </script>
<?php
}

add_action( 'wp_ajax_delete_sim_ajax', 'delete_sim_ajax' );
add_action( 'wp_ajax_nopriv_delete_sim_ajax', 'delete_sim_ajax' );

function delete_sim_ajax() {
    $response = [
        'delete' => 0
    ];

    if (!isset($_POST['sim']) || !isset($_POST['agency'])) {
        echo json_encode($response);
        exit;
    }
    $sim = $_POST['sim'];
    $agency = $_POST['agency'];

    $input_sim = explode(PHP_EOL, $sim);

    global $wpdb;
    $arraySim = array();
    foreach ($input_sim as $key => $simso) {
        $simso = remove_character($simso);
        $arraySim[] = $simso;
    }
    $arraySim = array_filter($arraySim);
    $stringSo = "(" . implode(',', $arraySim) . ")";

    if (isset($_POST['sim']) && $_POST['sim'] != '') {
        $query = "DELETE p
            FROM $wpdb->posts p
            WHERE post_type = 'sim'
            AND post_name in $stringSo";
    } else {
        $query = "DELETE p
            FROM $wpdb->posts p
            WHERE post_type = 'sim'
            AND agency = $agency";
    }

    if ($query) {
        $countAffected = $wpdb->query($query);
        $response['delete'] = (int) $countAffected;
    }
    $wpdb->flush();
    echo json_encode($response);
    exit;
}

function sim_exists($post_name) {
    global $wpdb;
    $sim = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '" . $post_name . "' AND post_type = 'sim'", OBJECT);
    if ($sim) {
        return $sim->ID;
    }
    return false;
}

// add search sim
function theme_search_where( $where ){
    global $pagenow, $wpdb;
    if ( is_admin()
        && $pagenow == 'edit.php'
        && ! empty( $_GET['post_type'] )
        && $_GET['post_type'] == 'sim'
        && !empty( $_GET['s'] ) ) {
        $s = $_GET['s'];
        $where = " AND (((post_title LIKE '%$s%')
            OR (post_excerpt LIKE '%$s%')
            OR (post_name LIKE '%$s%')
            OR (post_content LIKE '%$s%')))
            AND post_type = 'sim'";
    }
    return $where;
}
add_filter( 'posts_where', 'theme_search_where' );

add_shortcode('order_number', 'get_order_number');
function get_order_number() {
   return $_GET['order_number'];
}
add_shortcode('order_ten', 'get_order_ten');
function get_order_ten() {
   return $_GET['order_ten'];
}
add_shortcode('order_phone', 'get_order_phone');
function get_order_phone() {
   return $_GET['order_phone'];
}
add_shortcode('order_email', 'get_order_email');
function get_order_email() {
   return $_GET['order_email'];
}
add_shortcode('order_address', 'get_order_address');
function get_order_address() {
   return $_GET['order_address'];
}
add_shortcode('order_note', 'get_order_note');
function get_order_note() {
   return $_GET['order_note'];
}
add_shortcode('order_code', 'get_order_code');
function get_order_code() {
   return $_GET['order_code'];
}
add_shortcode('order_price', 'get_order_price');
function get_order_price() {
   return $_GET['order_price'];
}

function getGia($simId) {
    $gia = get_post_field('price', get_the_ID());
    if ($gia == 0) return 'Liên hệ';
    $status = get_post_status(get_the_ID());
    if ($status == 'sold') return 'Số đã bán';
    return number_format((int) $gia) . ' đ';
}

function remove_long($string) {
    $find = array("Lồn", "Buồi", "Bướm");
    $replace = array("xxx");
    return str_replace($find, $replace, $string);
}
