<?php
/**
 * foolish.computer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package foolish.computer
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function foolish_computer_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on foolish.computer, use a find and replace
		* to change 'foolish-computer' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'foolish-computer', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'foolish-computer' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'foolish_computer_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'foolish_computer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foolish_computer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'foolish_computer_content_width', 640 );
}
add_action( 'after_setup_theme', 'foolish_computer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foolish_computer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'foolish-computer' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'foolish-computer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'foolish_computer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function foolish_computer_scripts() {
    wp_enqueue_style( 'basic-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'extension-style', get_stylesheet_directory_uri() . "/style-extension.css", array('basic-style', 'foundation'), _S_VERSION );
	wp_enqueue_style( 'foundation', "https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/css/foundation.min.css" );
	wp_style_add_data( 'foolish-computer-style', 'rtl', 'replace' );

	wp_enqueue_script( 'foolish-computer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'jquery', "https://code.jquery.com/jquery-3.7.1.slim.min.js");

	wp_enqueue_script( 'foundation-script', "https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/js/foundation.min.js", array('jquery',));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foolish_computer_scripts' );

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
 * Category Colors
 */

function the_category_color($category) {
    echo "--category-color: ".get_category_color($category);
}

function get_category_color($category) {
    if (is_int($category)){
        return get_term_meta($category, "_catColor", true);
    }
    return get_term_meta($category->term_id, "_catColor", true);
}


function editCategoryColor(){
    $tagID = "";
    if (array_key_exists('tag_ID', $_POST))
    {
        $tagID = $_POST['tag_ID'];
    }
    else if (array_key_exists('tag_ID', $_GET))
    {
        $tagID = $_GET['tag_ID'];
    }
    $cat_color = get_term_meta($tagID, '_catColor', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_color"><?php _e('Category Display Color'); ?></label></th>
        <td>
            <input type="color" name="cat_color" id="cat_color" value="<?php echo $cat_color ?>"><br />
            <span class="description"><?php _e('Color for the Category '); ?></span>
        </td>
    </tr>
    <?php
}

function addCategoryColor(){
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_color"><?php _e('Category Display Color'); ?></label></th>
        <td>
            <input type="color" name="cat_color" id="cat_color" value=""><br />
            <span class="description"><?php _e('Color for the Category '); ?></span>
        </td>
    </tr>
    <?php

}
add_action ( 'category_edit_form_fields', 'editCategoryColor');
add_action ( 'category_add_form_fields', 'addCategoryColor');

function saveCategoryFields() {
    if ( isset( $_POST['tag_ID'] ) ) {
        update_term_meta($_POST['tag_ID'], '_catColor', $_POST['cat_color']);
    }
}
add_action ( 'edited_category', 'saveCategoryFields');
add_action ( 'created_category', 'saveCategoryFields');

function addCatColorToTable($string, $columns, $term_id ) {
    switch ( $columns ) {
        // in this example, we had saved some term meta as "genre-characterization"
        case '_catColor' :
            echo "<div style='height:50px;width:50px;background-color: ". get_term_meta( $term_id, '_catColor', true )."'></div>";
            break;
    }
}
add_action('manage_category_custom_column', 'addCatColorToTable', 15, 3);

add_filter( 'manage_edit-category_columns', 'addCatColorColumnToTable' );

function addCatColorColumnToTable( $columns ) {
    $columns['_catColor'] = __( 'Display Color' );
    return $columns;
}