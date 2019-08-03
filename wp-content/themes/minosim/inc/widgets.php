<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minosim_widget_left_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar left', 'minosim' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'minosim' ),
		'before_widget' => '<section id="%1$s" class="widget card mb-2 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title card-header">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'minosim_widget_left_init' );


function minosim_widget_right_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar right', 'minosim' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'minosim' ),
		'before_widget' => '<section id="%1$s" class="widget card mb-2 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title card-header">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'minosim_widget_right_init' );

function minosim_widget_footer_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'minosim' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here.', 'minosim' ),
		'before_widget' => '<div id="%1$s" class="col-md-4 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'minosim_widget_footer_init' );

/**
* Adds New Order widget
*/
class Neworder_Widget extends WP_Widget {

	/**
	* Register widget with WordPress
	*/
	function __construct() {
		parent::__construct(
			'neworder_widget', // Base ID
			esc_html__( 'Đơn hàng mới', 'minosim' ), // Name
			array( 'description' => esc_html__( 'Đơn hàng mới', 'minosim' ), ) // Args
		);
	}

	/**
	* Widget Fields
	*/
	private $widget_fields = array(
	);

	/**
	* Front-end display of widget
	*/
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		// Output widget title
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		} ?>
		<?php
		$queryArgs = array(
			'post_type' => 'order',
			'posts_per_page' => 5
		);
		$the_query = new WP_Query( $queryArgs );
		if ( $the_query->have_posts() ) {
			echo '<div class="p-2 orders">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					echo '<div class="order">
						<p class="name">' . remove_long(get_post_meta(get_the_ID(), 'order_ten', true)) . '</p>
						<p class="sim">Số sim: <b>' . substr(get_post_meta(get_the_ID(), 'order_number', true), 0, -3) . '***</b></p>
						<p class="time">Vào lúc: ' . date('d/m/Y H:i', get_post_time()) . '</p>
					</div>';
				}
			echo '</div>';
			wp_reset_postdata();
		}
		?>
		<?php
		echo $args['after_widget'];
	}

	/**
	* Back-end widget fields
	*/
	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $widget_field['default'], 'minosim' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'minosim' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'minosim' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'minosim' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	/**
	* Sanitize widget form values as they are saved
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
					break;
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
} // class Neworder_Widget

// register New Order widget
function register_neworder_widget() {
	register_widget( 'Neworder_Widget' );
}
add_action( 'widgets_init', 'register_neworder_widget' );