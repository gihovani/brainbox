<?php
/**
 * brainbox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package brainbox
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'brainbox_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function brainbox_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on brainbox, use a find and replace
		 * to change 'brainbox' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'brainbox', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'brainbox' ),
				'menu-2' => esc_html__( 'Footer', 'brainbox' ),
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
				'brainbox_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'brainbox_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brainbox_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'brainbox_content_width', 640 );
}
add_action( 'after_setup_theme', 'brainbox_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brainbox_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'brainbox' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'brainbox' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'brainbox_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brainbox_scripts() {


	//wp_enqueue_style( 'awesome-css', 'https://use.fontawesome.com/releases/v5.4.1/css/all.css' );
	//wp_enqueue_style( 'gfonts-css', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,700&display=swap' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap-5.0.0-b3.css' );
	wp_enqueue_style( 'tiny-css', get_template_directory_uri() . '/css/tiny-slider.css' );
	//wp_enqueue_style( 'lity-css', get_template_directory_uri() . '/css/lity-2.4.1.min.css' );
	wp_enqueue_style( 'css', get_template_directory_uri() . '/css/css.css' );
	wp_enqueue_style( 'up', get_template_directory_uri() . '/css/updates.css' );
	//wp_enqueue_style( 'brainbox-style', get_stylesheet_uri(), array(), _S_VERSION );
	//wp_style_add_data( 'brainbox-style', 'rtl', 'replace' );

	wp_enqueue_script( 'brainbox-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap-5.0.0-b3.bundle.min.js', 'jquery', '', true ); //Bootstrap's js
	wp_enqueue_script( 'tiny-js', get_template_directory_uri() . '/js/tiny-slider.js', 'jquery', '', true );
	//wp_enqueue_script( 'lity-js', get_template_directory_uri() . '/js/lity-2.4.1.min.js', 'jquery', '', true );
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/custom.js', array('jquery','tiny-js') , '', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}




}
add_action( 'wp_enqueue_scripts', 'brainbox_scripts' );

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





/********************************************/
/*************** CUSTOM STUFF ***************/
/********************************************/

// hide admin bar frontend
add_filter( 'show_admin_bar', '__return_false' );


// image sizes
add_image_size( '1920x850', 1920, 850, true );			// banner (home)
add_image_size( '768x340', 768, 340, true );			// banner mobile (home)
add_image_size( '356x200', 356, 200, true );				// thumb (cases)
add_image_size( '1920x235', 1920, 235, true );			// banner (cases)
add_image_size( '768x94', 768, 94, true );			// banner cases (mobile)
add_image_size( '550x550', 550, 550, true );				// thumbs (blog) / thumbs (lideranca-sobre)




// iframe wrapper
add_filter('the_content', function($content) {
	return str_replace(array("<iframe", "</iframe>"), array('<div class="iframe-container"><iframe', "</iframe></div>"), $content);
});
add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
	if(strpos($html, 'youtube.com') !== false || strpos($html, 'youtu.be') !== false){
		return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
	} else {
		return $html;
	}
}, 10, 4);
add_filter('embed_oembed_html', function($code) {
	return str_replace('<iframe', '<iframe class="embed-responsive-item" ', $code);
});



// slugfy
if( !function_exists( 'slugfy' ) ) {
	function slugfy($str, $rep = '-', $charset = 'utf-8')   {
		$str = htmlentities($str, ENT_COMPAT, $charset, false);                                                     // Convert special characters to HTML characters entities
    $str = preg_replace('/&([a-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|tilde|uml);/i', '\1', $str);   // Keep the leading letter of accented characters
    $str = preg_replace('/&([a-z]{2})lig;/i', '\1', $str);                                                      // Keep the leading two characters of ligarures
    $str = preg_replace('/&(?!amp)[a-z0-9]+;/i', '', $str);                                                     // Remove all other HTML character entities except &amp
		$str = preg_replace('/\W+/', '_', $str);																																		// (added) Remove ponctuation but not underscore
		$str = str_replace(' ', $rep, $str);                                                                        // Replace spaces with desired character
		$str = rtrim($str, $rep);																																										// Remove $rep from the end
    return strtolower($str);
	}
}


// excerpt limit by characters
// https://technumero.com/limit-excerpt-length-wordpress/#How_to_Limit_Excerpt_Length_in_WordPress
function get_excerpt_words( $limit = 50 ){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
	$excerpt = $excerpt.' [...]';
	//$excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
	return $excerpt;
}


// excerpt limit by words
// https://technumero.com/limit-excerpt-length-wordpress/#How_to_Limit_Excerpt_Length_in_WordPress
function get_excerpt2( $limit = 100 ) {
	$excerpt 		= explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt 	= implode(" ",$excerpt).' [...]';
	} else {
		$excerpt 	= implode(" ",$excerpt);
	}
	$excerpt 		= preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}


// acf for theme options
if( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(array(
		'page_title' 			=> 'Configurações do Site',
		'menu_title'			=> 'Configurações do Site',
		'menu_slug' 			=> 'configuracoes-do-site',
		'capability'			=> 'edit_posts',
		'parent_slug'			=> '',
		'position'				=> 90,
		'icon_url'				=> false,
		'redirect'				=> false
	));

	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Unidades',
		'menu_title'	=> 'Unidades',
		'parent_slug'	=> 'configuracoes-do-site',
	));
	*/

	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Alguma Outra Opção',
		'menu_title'	=> 'Mais Opções',
		'parent_slug'	=> 'meu-website',
	));
	*/

}



// this one works with child pages
// https://www.robbertvermeulen.com/get-page-id-by-template/
// $template = get_pages_by_template('template-empreendimentos.php'); $template_id = get_page_link($emp_search[0]);
if( !function_exists( 'get_pages_by_template' ) ) {
	function get_pages_by_template( $template ) {
    $args = array(
      'post_type'  => 'page',
      'fields'     => 'ids',
      'nopaging'   => true,
      'meta_key'   => '_wp_page_template',
      'meta_value' => $template
    );
    $pages = get_posts( $args );
    return $pages;
	}
}



// force 404
if( !function_exists( 'force404' ) ) {
	// https://richjenks.com/wordpress-throw-404/
	function force404() {

	  // 1. Ensure 'is_*' functions work
	  global $wp_query;
	  $wp_query->set_404();

	  // 2. Fix HTML title
	  add_action( 'wp_title', function () {
	    return '404: Not Found';
	  }, 9999 );

	  // 3. Throw 404
	  status_header( 404 );
	  nocache_headers();

	  // 4. Show 404 template
	  require get_404_template();

	  // 5. Stop execution
	  exit;

	}
}


// Move Yoast to bottom
if( class_exists('WPSEO_Options') ){
	function yoasttobottom() { return 'low'; }
	add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
}


// remove 'p' from contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');




// update jquery only on front end
// https://wordpress.stackexchange.com/questions/257317/update-jquery-version
// Front-end not excuted in the wp admin and the wp customizer (for compatibility reasons)
// See: https://core.trac.wordpress.org/ticket/45130 and https://core.trac.wordpress.org/ticket/37110
function wp_jquery_manager_plugin_front_end_scripts() {
    $wp_admin = is_admin();
    $wp_customizer = is_customize_preview();

    // jQuery
    if ( $wp_admin || $wp_customizer ) {
        // echo 'We are in the WP Admin or in the WP Customizer';
        return;
    }
    else {
        // Deregister WP core jQuery, see https://github.com/Remzi1993/wp-jquery-manager/issues/2 and https://github.com/WordPress/WordPress/blob/91da29d9afaa664eb84e1261ebb916b18a362aa9/wp-includes/script-loader.php#L226
        wp_deregister_script( 'jquery' ); // the jquery handle is just an alias to load jquery-core with jquery-migrate
        // Deregister WP jQuery
        wp_deregister_script( 'jquery-core' );
        // Deregister WP jQuery Migrate
        wp_deregister_script( 'jquery-migrate' );

        // Register jQuery in the head
        wp_register_script( 'jquery-core', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, false );

        /**
         * Register jquery using jquery-core as a dependency, so other scripts could use the jquery handle
         * see https://wordpress.stackexchange.com/questions/283828/wp-register-script-multiple-identifiers
         * We first register the script and afther that we enqueue it, see why:
         * https://wordpress.stackexchange.com/questions/82490/when-should-i-use-wp-register-script-with-wp-enqueue-script-vs-just-wp-enque
         * https://stackoverflow.com/questions/39653993/what-is-diffrence-between-wp-enqueue-script-and-wp-register-script
         */
        wp_register_script( 'jquery', false, array( 'jquery-core' ), null, false );
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_jquery_manager_plugin_front_end_scripts' );
function add_jquery_attributes( $tag, $handle ) {
    if ( 'jquery-core' === $handle ) {
        return str_replace( "type='text/javascript'", "type='text/javascript' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'", $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_jquery_attributes', 10, 2 );








// Custom post type 1 (case)
function custom_post_type1() {

  // Set UI labels for Custom Post Type
  $labels = array(
    'name'                => _x( 'Cases', 'Post Type General Name', 'brainbox' ),
    'singular_name'       => _x( 'Case', 'Post Type Singular Name', 'brainbox' ),
    'menu_name'           => __( 'Cases', 'brainbox' ),
    'parent_item_colon'   => __( 'Parent Cases', 'brainbox' ),
    'all_items'           => __( 'Cases', 'brainbox' ),
    'view_item'           => __( 'Veja o Case', 'brainbox' ),
    'add_new_item'        => __( 'Adicionar Novo Case', 'brainbox' ),
    'add_new'             => __( 'Adicionar Novo', 'brainbox' ),
    'edit_item'           => __( 'Editar Case', 'brainbox' ),
    'update_item'         => __( 'Atualizar Case', 'brainbox' ),
    'search_items'        => __( 'Procurar Case', 'brainbox' ),
    'not_found'           => __( 'Não há nenhum Case', 'brainbox' ),
    'not_found_in_trash'  => __( 'Não há nenhum Case na Lixeira', 'brainbox' ),
  );

  // Set other options for Custom Post Type
  $args = array(
    'label'               => __( 'Cases', 'brainbox' ),
    'description'         => __( 'Cases', 'brainbox' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'page-attributes', 'thumbnail'),
    //'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
	//'menu_icon'         => 'dashicons-cart',	// https://developer.wordpress.org/resource/dashicons/#arrow-up-alt2
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
	'show_in_rest' 				=> true,
	//'rewrite' 			  		=> array('slug' => 'planta', 'with_front' => false),
    // This is where we add taxonomies to our CPT
    //'taxonomies'          => array( 'category' )
  );

  // Registering your Custom Post Type
	register_post_type( 'case', $args );


	// Taxonomy
	$tax_args = array(
		'label'						=> 'Categorias',
		'singular_name' 			=> 'Categoria',
		'hierarchical' 				=> true,
		'show_admin_column' 		=> true,
		'show_in_rest' 				=> true,
	);
	register_taxonomy( 'categoria', 'case', $tax_args );

	// Taxonomy
	$tax_args2 = array(
		'label'						=> 'Tags',
		'singular_name' 			=> 'Tag',
		'hierarchical' 				=> false,
		'show_in_rest' 				=> true,
		//'show_admin_column' 	=> true,
	);
	register_taxonomy( 'case-tag', 'case', $tax_args2 );



}
add_action( 'init', 'custom_post_type1', 0 );

/*
function gp_register_taxonomy_for_object_type() {
  register_taxonomy_for_object_type( 'post_tag', 'case' );
};
add_action( 'init', 'gp_register_taxonomy_for_object_type' );
*/

add_action( 'pre_get_posts', 'case_tag_archive_query' );
function case_tag_archive_query( $query ) {
    if ( !is_admin() &&
        isset($query->query_vars['case-tag']) &&
        !empty($query->query_vars['case-tag'])) {
        $query->query_vars['posts_per_page'] = -1;
    }
    return $query;
}


function change_logo_class( $html ) {
  //$html = str_replace( 'custom-logo', 'logo-menu-principal', $html );
  //$html = str_replace( 'custom-logo-link', 'navbar-brand', $html );
	$html = str_replace( array('custom-logo-link', 'custom-logo'), array('navbar-brand', 'img-fluid'), $html );
  return $html;
}
add_filter( 'get_custom_logo', 'change_logo_class' );






// redirections
function template_redirections() {

	// redirect galeria taxs
  if( is_tax( 'categoria' ) ) {

		global $wp_query;
		$tax 						= $wp_query->get_queried_object();														// current tax
		$tem_page		  	= get_pages_by_template('template-cases.php');								// get the template

		if( $tem_page ) {
			$tem_page_url		= get_page_link($tem_page[0]);															// get the url
			$redirect				= $tem_page_url.'?'.$tax->taxonomy.'='.$tax->slug;					// make the filter
	  	wp_redirect( $redirect, 301 );
	    exit();
		}

  }

}
add_action( 'template_redirect', 'template_redirections' );

