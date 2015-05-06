<?php

if ( ! isset( $content_width ) ) $content_width = 940;

/* --------------------- Load Core Functions ------------------------- */
require_once( 'includes/core/codeless_config.php' );
require_once( 'includes/core/core-functions.php' );
/* --------------------- End Load Core ------------------------------ */

/* --------------------- Load MetaBoxes ----------------------------------- */
require_once 'includes/codeless-slider/codeless_slider_options.php';
require_once 'includes/core/codeless_metaboxes.php';
/* --------------------- End Load Metaboxes ------------------------------ */



require_once 'functions-specular.php';
require_once 'includes/core/codeless_routing.php';

/* -------------------- Load Codeless Import/Export ------------------ */
add_filter( "redux/cl_redata/field/class/codeless_import", "codeless_import_export_load" );
function codeless_import_export_load($field) {
    return dirname(__FILE__).'/admin/inc/fields/codeless_import/codeless_import.php'; 
}

/* -------------------- End Load Codeless Import/Export -------------- */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/framework.php' );
}


if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/includes/core/codeless_options.php' ) ) {
    require_once( dirname( __FILE__ ) . '/includes/core/codeless_options.php' );
}

require_once( dirname(__FILE__).'/admin/inc/fields/codeless_import/import_export.php');



/* --------------------- Custom Post Types Load ---------------------- */
require_once( 'includes/types/codeless_portfolio_type.php' );
require_once( 'includes/types/codeless_staff_type.php' );
require_once( 'includes/types/codeless_testimonial_type.php' );
require_once( 'includes/types/codeless_faq_type.php' );
/* --------------------- End Custom Post Types Load ------------------ */


/* --------------------- Register ------------------------------------ */
require_once 'includes/register/register_shortcodes.php';
require_once 'includes/register/register_sidebars.php';
/* --------------------- End Register -------------------------------- */


/* --------------------- Required Plugins Activation ----------------- */
require_once( 'includes/core/codeless_required_plugins.php' );
/* --------------------- Required Plugins Activation ----------------- */


/* --------------------- Codeless Slider Load ------------------------ */
require_once( 'includes/core/codeless_slideshow.php' );
require_once( 'includes/codeless-slider/codeless_slider_type.php' );
require_once( 'includes/codeless-slider/codeless_slider.php' );
/* --------------------- End Codeless Slider Load -------------------- */


/* --------------------- Post Like Load ------------------------------ */
require_once 'includes/post-like.php';
/* --------------------- End Post LIke Load -------------------------- */


/* --------------------- Load Widgets -------------------------------- */
require_once 'includes/widgets/codeless_flickr.php';
require_once 'includes/widgets/codeless_mostpopular.php';
require_once 'includes/widgets/codeless_shortcodewidget.php';
require_once 'includes/widgets/codeless_socialwidget.php';
require_once 'includes/widgets/codeless_topnavwidget.php';
require_once 'includes/widgets/codeless_twitter.php';
require_once 'includes/widgets/codeless_ads.php';
/* --------------------- End Load Widgets ---------------------------- */


/* -------------------- Load Shortcodes Generator -------------------- */
require_once( 'includes/core/shortcodes/shortcodes.php' );
/* -------------------- Load Shortcodes Generator -------------------- */

/* -------------------- Load Custom Menu ----------------------------- */
require_once( 'includes/core/codeless_megamenu.php' );
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Load Woocommerce Functions ----------------------------- */
if(class_exists( 'woocommerce' ))
    require_once( 'functions-woocommerce.php' );
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Setup Theme ---------------------------------- */

add_action( 'after_setup_theme', 'codeless_setup' );

function codeless_setup(){
    add_action('init', 'codeless_language_setup');
    add_action('wp_enqueue_scripts', 'codeless_register_global_styles');
    add_action('wp_enqueue_scripts', 'codeless_register_global_scripts');

    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );

    codeless_theme_support();
    codeless_images_sizes();
    codeless_navigation_menus();
    codeless_register_widgets();  
    new codeless_custom_menu();
}

/* -------------------- End Setup Theme --------------------------------- */


/* -------------------- PO/MO files ------------------------------------- */

function codeless_language_setup() {
    $lang_dir = get_template_directory() . '/lang';
    load_theme_textdomain('codeless', $lang_dir);
} 

/* -------------------- End PO/MO files --------------------------------- */



/* -------------------- Theme Support ----------------------------------- */

function codeless_theme_support(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('nav_menus');
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
}

/* -------------------- End Theme Support ------------------------------- */



/* -------------------- Add Various Image Sizes ------------------------ */

function codeless_images_sizes(){
    
    add_image_size( 'port3', 600, 600, true );
    add_image_size( 'port3_grayscale', 627, 470, true );
    add_image_size( 'port2', 460, 275, true );
    add_image_size( 'port2_grayscale', 940, 470, true );
    add_image_size( 'port4', 600, 600, true );

    add_image_size( 'blog', 825, 340, true );
    add_image_size( 'alternate_blog', 440, 195, true );
    add_image_size( 'alternate_blog_side', 355, 235, true );
    add_image_size( 'blog_grid', 350, 350, true );

    add_image_size( 'staff', 400, 270, true );
    add_image_size( 'staff_full', 500, 340, true );

}

/* -------------------- End Add Various Image Sizes --------------------- */


/* -------------------- Register Navigations ---------------------------- */

function codeless_navigation_menus(){
    global $cl_redata;
    $navigations = array('main' => 'Main Navigation');

    if(isset($cl_redata['header_style']) && $cl_redata['header_style'] == 'header_11')
        $navigations = array('left' => 'In left side of logo', 'right' => 'In right side of logo'); 

    foreach($navigations as $id => $name){ 
    	register_nav_menu($id, THEMETITLE.' '.$name); 
    }
}

/* -------------------- End Register Navigation ------------------------ */


/* -------------------- Register Widgets ------------------------------- */

function codeless_register_widgets(){
	register_widget( 'CodelessTwitter' );
    register_widget( 'CodelessSocialWidget' );
    register_widget( 'CodelessFlickrWidget' );
    register_widget( 'CodelessShortcodeWidget' );
    register_widget( 'CodelessMostPopularWidget');
    register_widget( 'CodelessTopNavWidget');
    register_widget( 'CodelessAdsWidget');
}

/* -------------------- End Register Widgets ------------------------ */


/* -------------------- Register Styles used over all pages --------- */

function codeless_register_global_styles(){
    global $cl_redata;   
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap-responsive');
    wp_enqueue_style('jquery.fancybox');
    wp_enqueue_style('vector-icons');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('linecon');
    wp_enqueue_style('steadysets');
    wp_enqueue_style('hoverex');
    wp_enqueue_style( 'jquery.easy-pie-chart' );
    wp_enqueue_style( 'idangerous.swiper');
    if( (isset($cl_redata['fullscreen_post_style']) && $cl_redata['fullscreen_post_style']) || $cl_redata['fullscreen_sections_active'] )
        wp_enqueue_style('fullscreen_post_css');
}

/* -------------------- Register Styles used over all pages --------- */



/* -------------------- Register Scripts used over all pages --------- */

function codeless_register_global_scripts(){
            
    global $cl_redata;
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'bootstrap.min' );
    wp_enqueue_script( 'jquery-easing-1-1' );
    wp_enqueue_script( 'jquery-easing-1-3' );
    wp_enqueue_script( 'jquery.mobilemenu' );
    
    wp_enqueue_script( 'isotope');

    if($cl_redata['nicescroll'])
        wp_enqueue_script('smoothscroll'); 

    wp_enqueue_script('jquery.flexslider-min');
    wp_enqueue_script('jquery.fancybox');
    wp_enqueue_script('jquery.fancybox-media');
    wp_enqueue_script('jquery.carouFredSel-6.1.0-packed'); 
    wp_enqueue_script('jquery.hoverex'); 
    /*wp_enqueue_script('mediaelementplayer'); */
    wp_enqueue_script('tooltip'); 
    wp_enqueue_script( 'jquery.parallax' );
    wp_enqueue_script( 'main' );
    wp_enqueue_script('comment-reply');
    wp_enqueue_script('placeholder');
    wp_enqueue_script('countdown');
    wp_enqueue_script( 'waypoints.min');
    wp_enqueue_script( 'idangerous.swiper');   
    wp_enqueue_script('jquery.appear');
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script('jquery.countTo');
    wp_enqueue_script('animations');  
    wp_enqueue_script('background-check.min');
    wp_enqueue_script( 'jquery.fullPage'); 
    wp_enqueue_script('skrollr');
    wp_enqueue_script('select2');
    wp_enqueue_script('jquery.slicknav.min'); 
    wp_enqueue_script('classie'); 
    wp_enqueue_script('mixitup'); 
    wp_enqueue_script('masonry');
    wp_enqueue_script('jquery.onepage');
    wp_enqueue_script('imagesloaded');

    if(isset($cl_redata['fullscreen_post_style']) && $cl_redata['fullscreen_post_style'] )
        wp_enqueue_script('fullscreen_post');

    
    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    echo "var codeless_global = { \n \tajaxurl: '".esc_js(admin_url( 'admin-ajax.php' ) )."',\n \tbutton_style: '".esc_js($cl_redata['overall_button_style'][0])."'\n \t}; \n /* ]]> */ \n ";
    echo "</script>\n \n ";
}

/* -------------------- Register Scripts used over all pages --------- */ 

/* -------------------- WP TITLE Filter ------------------------------ */

function themeple_wp_title_filter( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}

add_filter( 'wp_title', 'themeple_wp_title_filter', 10, 2 );

/* -------------------- End WP Title Filter -------------------------- */

?>