<?php
/**
 * Theme Functions.
 */

if ( ! function_exists( 'electronics_marketplace_setup' ) ) :

/* Theme Setup */
function electronics_marketplace_setup() {

	$GLOBALS['content_width'] = apply_filters( 'electronics_marketplace_content_width', 640 );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', ecommerce_solution_font_url() ) );

}
endif; 
add_action( 'after_setup_theme', 'electronics_marketplace_setup' );

add_action( 'wp_enqueue_scripts', 'electronics_marketplace_enqueue_styles' );
function electronics_marketplace_enqueue_styles() {
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/css/bootstrap.css');
	$parent_style = 'ecommerce-solution-basic-style'; // Style handle of parent theme.
	wp_enqueue_style( $parent_style, esc_url(get_template_directory_uri()) . '/style.css' );
	wp_enqueue_style( 'electronics-marketplace-style', get_stylesheet_uri(), array( $parent_style ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/* Theme Widgets Setup */
function electronics_marketplace_widgets_init() {
	//Footer widget areas
	$ecommerce_solution_widget_areas = get_theme_mod('footer_widget_areas', '4');
	for ($i=1; $i<=$ecommerce_solution_widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'electronics-marketplace' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'electronics_marketplace_widgets_init' );

function electronics_marketplace_customizer_register() { 
	global $wp_customize;
	$wp_customize->remove_section( 'ecommerce_solution_example_1' );
	$wp_customize->remove_section( 'ecommerce_solution_global_color' );
} 
add_action( 'customize_register', 'electronics_marketplace_customizer_register', 11 );

add_action( 'init', 'electronics_marketplace_remove_parent_function');
function electronics_marketplace_remove_parent_function() {
	remove_action('admin_notices', 'ecommerce_solution_notice');
	remove_action( 'admin_menu', 'ecommerce_solution_gettingstarted' );
}

define('ELECTRONICS_MARKETPLACE_CREDIT',__('https://www.buywptemplates.com/themes/free-marketplace-wordpress-theme/', 'electronics-marketplace'));

if ( ! function_exists( 'electronics_marketplace_credit' ) ) {
	function electronics_marketplace_credit(){
		echo "<a href=".esc_url(ELECTRONICS_MARKETPLACE_CREDIT)." target='_blank'>".esc_html__('Marketplace WordPress Theme','electronics-marketplace')."</a>";
	}
}

/*--------------section-pro.php part------------------------------*/
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );

class Electronics_Marketplace_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'electronics-marketplace';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

/*---------------customizer.php part--------------------------*/
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Electronics_Marketplace_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Electronics_Marketplace_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Electronics_Marketplace_Customize_Section_Pro(
				$manager,
				'electronics_marketplace_example',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Electronics Pro', 'electronics-marketplace' ),
					'pro_text' => esc_html__( 'Go Pro', 'electronics-marketplace' ),
					'pro_url'  => esc_url('https://www.buywptemplates.com/themes/electronics-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */

	public function enqueue_control_scripts() {

		wp_enqueue_script( 'electronics-marketplace-customize-controls', get_stylesheet_directory_uri() . '/js/customize-controls-child.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'electronics-marketplace-customize-controls', get_stylesheet_directory_uri() . '/css/customize-controls-child.css' );
	}
}

// Doing this customizer thang!
Electronics_Marketplace_Customize::get_instance();