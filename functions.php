<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */














if ( ! function_exists( 'ct_custom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ct_custom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CT Custom, use a find and replace
		 * to change 'ct-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
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
		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ct_custom_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}




// Creating custom theme settings 
function add_theme_menu_item()
{
	add_menu_page("Theme Settings", "Theme Settings", "manage_options", "theme-settings", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme Settings</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

// logo uplaod code
function logo_display()
{
	?>
        <input type="file" name="logo" /> 
        <?php echo get_option('logo'); ?>

        
   <?php
}

function handle_logo_upload()
{
	if(!empty($_FILES["demo-file"]["tmp_name"]))
	{
		$urls = wp_handle_upload($_FILES["logo"], array('test_form' => FALSE));
	    $temp = $urls["url"];
	    return $temp;  


	}

	  
	return $option;
}

// contact number

function display_phonenumber_element()
{
	?>
    	<input type="tel" name="phone_number" id="phone_number" value="<?php echo get_option('phone_number'); ?>" />
    <?php
}
// Address Information

function display_address_element(){
	?>
	<input type="text" name="address" id="address" value="<?php echo get_option('address'); ?>" />
	<?php
}

// Fax Number 
function display_fax_number_element(){
	?>
	<input type="text" name="fax_number" id="fax_number" value="<?php echo get_option('fax_number'); ?>" />
	<?php
}


// social media links

function display_twitter_element()
{
	?>
    	<input type="url" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="url" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}
function display_linkedin_element()
{
	?>
    	<input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo get_option('linkedin_url'); ?>" />
    <?php
}

function display_pinterest_element()
{
	?>
    	<input type="url" name="pinterest_url" id="pinterest_url" value="<?php echo get_option('pinterest_url'); ?>" />
    <?php
}




// showing fields in theme settings 
function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");

	add_settings_field("logo", "Logo", "logo_display", "theme-options", "section"); 
	add_settings_field("phone number", "Phone Number", "display_phonenumber_element", "theme-options", "section");
	add_settings_field("address", "Address Information", "display_address_element", "theme-options", "section" ); 
	add_settings_field("fax number", "Fax Number", "display_fax_number_element", "theme-options", "section" ); 

	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("linkedin_url", "Linkedin Profile Url", "display_linkedin_element", "theme-options", "section");
    add_settings_field("pinterest_url", "Pinterest Profile Url", "display_pinterest_element", "theme-options", "section");
    
    register_setting("section", "logo", "handle_logo_upload");
    register_setting("section", "phone_number");
    register_setting("section", "address");
    register_setting("section", "fax_number");
    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "linkedin_url");
    register_setting("section", "pinterest_url");
    
}

add_action("admin_init", "display_theme_panel_fields");


// custom theme option code end

// breadcrums code //

function get_breadcrumb() {
	
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#47;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#47;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#47;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo " &nbsp;&nbsp;&#47;&nbsp;&nbsp;";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}


// contact us widget code here 
 function coalitiontest_footer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'footer', 'coalition widget' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'coalition widget' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'coalitiontest_footer_widgets_init' );



 function coalitiontest_reachus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Reach us', 'coalition widget' ),
		'id'            => 'reachus-1',
		'description'   => esc_html__( 'Add widgets here.', 'coalition widget' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'coalitiontest_reachus_widgets_init' );



// short url code

function theme_option_content() {
	$layout = get_option('theme_layout');
	$facebook_url = get_option('facebook_url');
	$twitter_url = get_option('twitter_url'); 
	$linkedin = get_option('linkedin_url');
	$pinterest = get_option('pinterest_url'); 


	$address = get_option('address'); 
	$phone = get_option('phone_number'); 
	$fax = get_option('fax_number'); 
	?>

	<div class="reach-us">
	<p class="reachus-location"><?php echo $address ?></p>
	<p>Phone:<?php echo $phone ?></p>
	<p>Fax:<?php echo $fax ?></p>
	</div>

	<div class="share-links">
		<a href="<?php echo $twitter_url; ?>" target="blank"><i class="fa-brands fa-twitter"></i></a>
		<a href="<?php echo $facebook_url; ?>" target="blank"><i class="fa-brands fa-facebook-f"></i></a>
		<a href="<?php echo $linkedin; ?>" target="blank"><i class="fa-brands fa-linkedin-in"></i></a>
		<a href="<?php echo $pinterest; ?>" target="blank"><i class="fa-brands fa-pinterest"></i></a>

		
		
		
	</div>	
	



	<?php
}
add_shortcode('Footer-Content','theme_option_content');




/**
 * Font Awesome Kit Setup
 * 
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
/**
 * Register and load font awesome CSS files using a CDN.
 */
function prefix_enqueue_awesome() {
	wp_enqueue_style( 
		'font-awesome-5', 
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css', 
		array(), 
		'6.2.1'
	);}
