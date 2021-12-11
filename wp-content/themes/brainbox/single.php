<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package brainbox
 */




// cats
$cats											= '';
$catss 										= get_the_category( $post->ID );
foreach($catss as $c) 		{ $cats .= '<span class="tag">'.$c->name.'</span>, '; }
$cats											= rtrim($cats, ', ');
$tax_query[]    = array(
	'taxonomy'    => 'category',
	'field'       => 'slug',
	'terms'       => $catss[0]->slug,
);


// image
$img_full			= '';
if( has_post_thumbnail() ) {
	$img_id 				= get_post_thumbnail_id(get_the_ID());
	$img_full				= wp_get_attachment_image_src($img_id, 'full');
	$img_full				= $img_full[0];
	$img_alt 				= get_post_meta($img_id , '_wp_attachment_image_alt', true);
}


// related
$args			      = array(
	'post_type' 			=> 'post',
	'post_status'     => 'publish',
	'posts_per_page'  => 3,
	//'orderby' 				=> 'menu_order',
  //'order' 					=> 'ASC',
	'tax_query'       => $tax_query,
	'post__not_in'		=> array($post->ID),
	//'paged'           => $paged,
	//'post__in'				=> $ids,
	//'orderby' 				=> 'title',
	//'order' 					=> 'ASC',
);
$query		      = new WP_Query( $args );



get_header();
?>

	<main id="primary" class="site-main">


		<?php while ( have_posts() ) : the_post(); ?>

			<div id="blogview-faixa-linha-superior" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 caseview-faixa-linha-superior-content-container">
											<?php echo $cats; ?> <?php echo get_the_date(); ?>
											<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="ms-auto">VOLTAR PARA O BLOG<img src="<?php echo get_template_directory_uri(); ?>/images/icos/bigger.png" class="ms-3"></a>
									</div>
							</div>
					</div>
			</div>


			<div id="blogview-faixa-titulo" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 blogview-faixa-titulo-content-container">
											<h3><b><?php the_title(); ?></b></h3>
									</div>
							</div>
					</div>
			</div>


			<div id="blogview-faixa-content" class="mt-3">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 blogview-faixa-content-content-container">
										<?php the_content(); ?>
									</div>
							</div>
					</div>
			</div>


			<?php if( $query->have_posts() ) { ?>
			<div id="blogview-faixa-posts-relacionados" class="mt-5">
	      	<div class="container-xl">
	              <div class="row">
	                  <div class="col-12">
	                      <span class="titulo-area">Postagens Relacionadas</span>
	                  </div>
	              </div>
	              <div class="row">
									<?php
									while( $query->have_posts() ) : $query->the_post();

										// image
										$img_src				 	= '';
										$img              = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '356x200' );
										if( $img )				{ $img_src = $img[0]; }

									?>
	                  <div class="col-12 col-sm-4">
	                      <div class="card-case">
	                          <a href="<?php echo get_the_permalink(); ?>">
	                              <div class="card-case-img-wrapper">
	                                  <img src="<?php echo $img_src; ?>">
	                              </div>
	                          </a>
	                          <p class="card-case-titulo"><?php echo get_the_title(); ?></p>
	                      </div>
	                  </div>
                	<?php endwhile; wp_reset_postdata(); ?>
	              </div>
	          </div>
      </div>
			<?php } ?>


			<div class="share-buttons-container-horizontal">
					<div class="share-buttons-container-vertical">
							<div class="share-buttons-container">
									<!-- <a href="#share"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-share-instagram.png"></a> -->
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-share-facebook.png"></a>
									<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-share-twitter.png"></a>
									<a href="https://pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo $img_full; ?>&description=<?php the_title(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-share-pinterest.png"></a>
							</div>
					</div>
			</div>


		<?php endwhile; ?>


		<?php get_template_part( 'template-parts/content', 'newsletter' ); ?>


	</main><!-- #main -->

<?php
get_footer();
