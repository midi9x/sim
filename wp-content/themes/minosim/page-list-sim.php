<?php
/**
 * Template Name: Danh sách sim
 *
 * @package MinoSim
 */
$keyword = get_query_var('keyword');
if ($keyword) {
    function filter_wpseo_canonical($canonical) {
        global $keyword;
        return $canonical . $keyword . '/';
    }
    add_filter( 'wpseo_canonical', 'filter_wpseo_canonical', 10, 1 );
    add_filter( 'wpseo_opengraph_url', 'filter_wpseo_canonical', 10, 1 );

    function filter_wpseo_title($title) {
        global $keyword;
        if ($keyword) {
            $title = 'Tìm sim ' . $keyword . ' - Sim số ' . $keyword . ' giá rẻ';
        }
        return $title;
    }
    add_filter( 'wpseo_title', 'filter_wpseo_title', 10, 1 );

    function filter_wpseo_metadesc($desc) {
        global $keyword;
        if ($keyword) {
            $desc = 'Tìm sim ' . $keyword . ' - Sim số ' . $keyword . ' giá rẻ';
        }
        return $desc;
    }
    add_filter( 'wpseo_metadesc', 'filter_wpseo_metadesc', 10, 1 );
}

get_header();

?>

    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-md-6 order-md-2 px-md-0 bg-white">
                <main id="main" class="site-main p-2" role="main">
                    <?php get_search_sim_form(); ?>
                    <?php if (!is_front_page()):
                        $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    ?>
                        <header class="entry-header">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </header><!-- .entry-header -->
                    <?php else:
                        $page = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
                    ?>
                    <?php endif; ?>

                    <?php get_filter_sim_form(); ?>
                    <?php
                    $args = array(
                        'post_type' => 'sim',
                        'post_status' => 'publish',
                        'paged' => $page
                    );

                    $query = '';

                    $keyword = $keyword ? $keyword : get_post_meta(get_the_ID(), '$keyword', true );
                    if ($keyword) {
                        if (strpos($keyword, '*') !== false) {
                            $keyword = str_replace('*', '%', $keyword);
                        } else {
                            $keyword = '%' . $keyword . '%';
                        }
                        $query .= " AND post_name LIKE '$keyword'";
                    }

                    $getLoaiSim = get_post_meta(get_the_ID(), 'loaisim', true );
                    global $loaiSim;
                    if ($getLoaiSim && isset($loaiSim[$getLoaiSim])) {
                        if (is_array($loaiSim[$getLoaiSim])) {
                            $query .= " AND (" . join(" AND ", $loaiSim[$getLoaiSim]) . ")";
                        } else {
                            $query .= " AND (" . $loaiSim[$getLoaiSim] . ")";
                        }
                    }
                    $getNhaMang = isset($_GET['nhamang']) ? $_GET['nhamang'] : get_post_meta(get_the_ID(), 'nhamang', true );
                    global $nhaMang;
                    if (isset($getNhaMang) && isset($nhaMang[$getNhaMang])) {
                        $query .= " AND (" . $nhaMang[$getNhaMang] . ")";
                    }

                    $dauso = get_post_meta(get_the_ID(), 'dauso', true );
                    if ($dauso) {
                        $len = strlen($dauso);
                        $query .= " AND (LEFT(`post_name`, $len) = $dauso)";
                    }

                    $duoiso = get_post_meta(get_the_ID(), 'duoiso', true );
                    if ($duoiso) {
                        $len = strlen($duoiso);
                        $query .= " AND (RIGHT(`post_name`, $len) = $duoiso)";
                    }

                    $giaTu = isset($_GET['giatu']) ? $_GET['giatu'] : get_post_meta(get_the_ID(), 'giatu', true );
                    $giaDen = isset($_GET['giaden']) ? $_GET['giaden'] : get_post_meta(get_the_ID(), 'giaden', true );

                    if (isset($giaTu) || isset($giaDen)) {
                        if ($giaTu) {
                            $query .= " AND price >= $giaTu";
                        }
                        if ($giaDen) {
                            $query .= " AND price <= $giaDen";
                        }
                    }
                    if (isset($_GET['sapxep'])) {
                        $sapxep = $_GET['sapxep'];
                        if ($sapxep == 1) {
                            $order   = 'ASC';
                        } else {
                            $order   = 'DESC';
                        }
                        $args['orderby'] = 'none';
                        $query .= " ORDER BY wpsim_posts.price $order";
                    }

                    if ($query) {
                        $args['timsim'] = $query;
                    }

                    $wp_query = new WP_Query( $args );

                    if ( $wp_query->have_posts() ) :
                    ?>
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="d-none d-md-table-cell">#</th>
                                    <th>Số sim</th>
                                    <th class="d-none d-md-table-cell">Nhà mạng</th>
                                    <th>Giá bán</th>
                                    <th class="d-none d-md-table-cell">Loại sim</th>
                                    <th>Đặt mua</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                        /* Start the Loop */
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();

                            get_template_part( 'template-parts/content', 'sim' );

                        endwhile;

                    ?>
                            </tbody>
                        </table>
                    <?php
                        wpbs_pagination();
                    else :

                        get_template_part( 'template-parts/single-sim', 'none' );

                    endif; ?>
                    <?php
                        wp_reset_postdata();
                        wp_reset_query();
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        <?php
            get_sidebar('left');
            get_sidebar('right');
        ?>
<?php
get_footer();
