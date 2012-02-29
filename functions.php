<?php

namespace WordPress\Themes\Genesis\Turbo;

class Theme {

	private $genesis_engine = NULL; 

	public $theme_information = array();

	function __construct() {
		$this->configure_theme();
		$i_can_haz_engine = $this->start_genesis_framework();
		if( $i_can_haz_engine === true ) {
			$this->specify_theme_features();
			$this->build_footer();
		}
	}

	function configure_theme() {
		$this->theme_information[ 'ThemePath' ] = dirname( __FILE__ );
		$this->theme_information[ 'ThemeURL' ] = get_bloginfo( 'stylesheet_directory' );
		$this->genesis_engine = TEMPLATEPATH . '/lib/init.php';

		$this->setup_administration_area();
	}

	function setup_administration_area() {
		add_action( 'admin_menu' , array( &$this, 'add_menu_item' ) );
		$this->register_defaults();
	}

	function add_menu_item() {
		add_theme_page(
			'Turbo: Theme Options',
			'Theme Options',
			'edit_theme_options',
			'turbo-theme-options',
			array( &$this , 'options_page' )
		);
	}

	function options_page() {
		include( $this->theme_information[ 'ThemePath' ] . '/options.php' );
	}

	function register_defaults() {
		register_default_headers(
			array(
				'red' => array(
					'url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/red.gif',
					'thumbnail_url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/red.gif',
					'description' => __( 'Red', 'turbo' )
				),
				'blue' => array(
					'url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/blue.gif',
					'thumbnail_url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/blue.gif',
					'description' => __( 'Blue', 'turbo' )
				),
				'green' => array(
					'url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/green.gif',
					'thumbnail_url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/green.gif',
					'description' => __( 'Green', 'turbo' )
				),
				'orange' => array(
					'url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/orange.gif',
					'thumbnail_url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/orange.gif',
					'description' => __( 'Orange', 'turbo' )
				),
				'grey' => array(
					'url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/grey.gif',
					'thumbnail_url' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/grey.gif',
					'description' => __( 'Grey', 'turbo' )
				)
			)
		);
	}

	function start_genesis_framework() {
		if( file_exists ( $this->genesis_engine ) ) {
			require_once( $this->genesis_engine );
			return true;
		} else {
			$this->failed_to_start();
			return false;
		}
	}

	function failed_to_start() {
		add_action( 'admin_notices' , array( &$this , 'could_not_find_genesis' ) );
		add_action( 'init' , array( &$this, 'deactivate_theme' ) );
	}

	function could_not_find_genesis() {
		echo '<div id="message" class="error">';
		echo '<p>Unable to locate the Genesis Framework!</p>';
		echo '</div>';
		echo '<div id="message" class="error">';
		echo '<p id="message" class="error">Deactivating Turbo.</p>';
		echo '</div>';
	}

	function deactivate_theme() {
		switch_theme( WP_DEFAULT_THEME , WP_DEFAULT_THEME );
	}

	function specify_theme_features() {
		add_filter( 'widget_text' , 'do_shortcode' );
		$before_widget = '<div id="%1$s" class="widget %2$s turbo-theme widget-area">';
		$after_widget = '</div>';
		$before_title = '<h4 class="widget-title">';
		$after_title = '</h4>';
		add_custom_background();
		add_theme_support(
			'genesis-custom-header',
			array(
				'width' => 960,
				'height' => 100,
				'header_image' => $this->theme_information[ 'ThemeURL' ] . '/img/headers/red.gif'
			)
		);
		genesis_register_sidebar(
			array(
				'name' => 'Home Top - Left',
				'description' => 'This is the top left section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name'=>'Home Top - Right',
				'description' => 'This is the top right section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name'=>'Home Middle - Full',
				'description' => 'This is a full width content area for the home page.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name' => 'Home Middle - Left',
				'description' => 'This is the bottom left section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name' => 'Home Middle - Middle',
				'description' => 'This is the bottom middle section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name'=>'Home Middle - Right',
				'description' => 'This is the bottom right section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name' => 'Home Bottom - Left',
				'description' => 'This is the bottom left section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		genesis_register_sidebar(
			array(
				'name'=>'Home Bottom - Right',
				'description' => 'This is the bottom right section of the homepage.',
				'before_widget' => $before_widget,
				'after_widget' => $after_widget,
				'before_title' => $before_title,
				'after_title' => $after_title
			)
		);
		add_theme_support( 'genesis-footer-widgets' , 2 );
	}

	function build_footer() {
		add_filter( 'genesis_footer_creds_text' , array( &$this , 'add_credits' ) );
		add_filter( 'genesis_footer_output' , array( &$this , 'add_footer_menu' ) );
	}

	function add_credits( $credits ) {
		$credits = '[footer_copyright] &bull; Turbo Theme by <a href="http://www.dealertrend.com" title="DealerTrend, Inc." target="_blank">DealerTrend, Inc.</a> &bull; Built on the [footer_genesis_link]';

		return $credits;
	}

	function add_footer_menu( $instance ) {
		$menu = wp_nav_menu( array( 'menu' => 'Footer Menu' , 'theme_location' => 'footer-menu' ) );

		return $instance . $menu;
	}

}

global $Turbo;

$Turbo = new Theme();

?>
