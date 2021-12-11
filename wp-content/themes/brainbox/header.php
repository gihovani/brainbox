<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brainbox
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site site-limit">

	<header>
	    <a name="topo"></a>
	    <div class="container-xl">
	        <div class="row">
	            <div class="col">
	                <nav class="navbar navbar-light navbar-expand-lg">
	                    <div class="d-flex flex-grow-1 flex-lg-grow-0">
													<?php the_custom_logo(); ?>
	                        <button class="navbar-toggler ms-auto border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menus-header">
	                            <span class="navbar-toggler-icon"></span>
	                        </button>
	                    </div>
	                    <div id="menus-header" class="collapse navbar-collapse flex-column flex-lg-row">
	                        <!-- ul menu primario -->
													<?php
													wp_nav_menu(
														array(
															'theme_location' 		=> 'menu-1',
															'menu_id'        		=> 'primary-menu',
															'container_class'   => 'menu-primario',
														)
													);
													?>
	                        <!-- ul redes sociais -->
	                        <div class="menu-redes-sociais-primario d-flex align-self-stretch align-self-lg-center justify-content-end">
	                            <ul>
	                                <?php if( $url = get_field('cf_ms_link', 'options') ) { ?><li><a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/linkedin.png"></a></li><?php } ?>
	                                <?php if( $url = get_field('cf_ms_inst', 'options') ) { ?><li><a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/instagram.png"></a></li><?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </nav>
	            </div>
	        </div>
	    </div>
	</header>
