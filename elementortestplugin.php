<?php

/**
 * Plugin Name: ElementorTestPlugin
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Momin Sarder
 * Author URI:  https://developers.elementor.com/
 * Text Domain: etp
 * 
 * Elementor tested up to: 3.15.0
 * Elementor Pro tested up to: 3.15.0
 */

if (!defined('ABSPATH')) {
	die(__('direct access is not allowed', 'etp'));
}

function plugin_scripts_enqueue()
{

	//slick slider css
	wp_enqueue_style('slick_slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

	//owl carousel css
	wp_enqueue_style('owl_carousel', plugins_url('/assets/css/owl.carousel.min.css', __FILE__), array(), 'v2.3.4', 'all');

	//owl carousel css
	wp_enqueue_style('owl_theme_carousel', plugins_url('/assets/css/owl.theme.default.min.css', __FILE__), array(), 'v2.3.4', 'all');

	//slick slider js
	wp_enqueue_script('slick_slider', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '6.2.2', true);

	//custom css for plugin
	wp_enqueue_style('pluginStyle', plugins_url('/assets/css/plugin-style.css', __FILE__));

	//owl minified js
	wp_enqueue_script('owl_scripts', plugins_url('/assets/js/owl.carousel.min.js', __FILE__), array(), 'v2.3.4', true);
	//custom js
	wp_enqueue_script('custom-script', plugins_url('/assets/js/custom.js', __FILE__), array(), '1.0.0', true);



	/**
	 * split assets
	 * 
	 */
	wp_enqueue_style('split-main', plugins_url('/assets/css/split-main.css', __FILE__), array(), '1.0.0', 'all');


	wp_enqueue_script('ms_custom_gspa-main', plugins_url('/assets/js/gsap-beta.min.js', __FILE__), array(), '1.0.0', true);
	wp_enqueue_script('ms_custom-scroll-triger', plugins_url('/assets/js/gsap-scroll-triger.min.js', __FILE__), array(), '1.0.0', true);
	wp_enqueue_script('ms_custom-split-text', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js', array(), '1.0.0', true);
	wp_enqueue_script('ms_custom-split-main', plugins_url('/assets/js/spite-main.js', __FILE__), array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'plugin_scripts_enqueue');

function elementor_test_plugin()
{

	// Load plugin file
	require_once(__DIR__ . '/includes/widgets-manager.php');
	require_once(__DIR__ . '/includes/controls-manager.php');
}
add_action('plugins_loaded', 'elementor_test_plugin');

// final classes

final class Plugin
{

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible()
	{

		// Check if Elementor is installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'etp'),
			'<strong>' . esc_html__('Elementor Test Addon', 'etp') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'etp') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'etp'),
			'<strong>' . esc_html__('Elementor Test Addon', 'etp') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'etp') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'etp'),
			'<strong>' . esc_html__('Elementor Test Addon', 'etp') . '</strong>',
			'<strong>' . esc_html__('PHP', 'etp') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init()
	{
		load_plugin_textdomain('etp');

		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		// add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );


	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		require_once(__DIR__ . '/includes/widgets/widget-1.php');
		require_once(__DIR__ . '/includes/widgets/hello-world.php');
		require_once(__DIR__ . '/includes/widgets/hover-team-member.php');
		require_once(__DIR__ . '/includes/widgets/team-member-addon.php');
		require_once(__DIR__ . '/includes/widgets/team-member-carousel.php');
		require_once(__DIR__ . '/includes/widgets/logo-carousel.php');
		require_once(__DIR__ . '/includes/widgets/split-text.php');
		// require_once( __DIR__ . '/includes/widgets/mukto-hover.php' ); style are'nt available

		$widgets_manager->register(new Widget_1());
		$widgets_manager->register(new Hello_World_Widget());
		$widgets_manager->register(new Hover_Team_Member());
		$widgets_manager->register(new Team_Members_Addon());
		$widgets_manager->register(new Card_Carousel());
		$widgets_manager->register(new LogoCarousel());
		$widgets_manager->register(new SplitText());
		// $widgets_manager->register( new new_rwhm_team_viewer() );  style are'nt available

	}
}

\Plugin::instance();
