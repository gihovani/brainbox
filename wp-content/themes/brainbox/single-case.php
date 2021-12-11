<?php


// cases template
$temp_cases_id		= false;
$temp_cases 			= get_pages_by_template('template-cases.php');
if( $temp_cases ) { $temp_cases_id = $temp_cases[0]; }


// cats
$tax_query      	= array();
$cats_html				= '';
$cats							= get_the_terms( $post->ID, 'categoria' );
if( $cats ) {
	foreach( $cats as $cat ) :
		$cats_html	.= $cat->name.', ';
	endforeach;
	$cats_html			= rtrim( $cats_html, ', ' );
	$tax_query[]    = array(
		'taxonomy'    => 'categoria',
		'field'       => 'slug',
		'terms'       => $cats[0]->slug,
	);
}


// title
$title						= get_the_title();
if( get_field('cs_bt_title') )	{ $title = get_field('cs_bt_title'); }


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
	'post_type' 			=> 'case',
	'post_status'     => 'publish',
	'posts_per_page'  => 3,
	'orderby' 			=> array('menu_order' => 'DESC', 'date' => 'DESC'),
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


			<!-- imagens do banner superior -->
			<?php if(wp_is_mobile()) : 
					if(get_field('cs_bt_img_mobile')) {
						$img = get_field('cs_bt_img_mobile');
					} else {
						$img = get_field('cs_bt_img');
					}
			?>
				<div id="caseview-faixa-banner-superior">
					<img src="<?php echo $img['sizes']['768x94']; ?>" class="img-fluid d-none d-sm-none d-md-none d-lg-none d-xl-block">
				</div>
			<?php else : 
				$img = get_field('cs_bt_img');
				?>
				<div id="caseview-faixa-banner-superior">
					<img src="<?php echo $img['sizes']['1920x235']; ?>" class="img-fluid d-none d-sm-none d-md-none d-lg-none d-xl-block">
				</div>
			<?php endif; ?>


			<div id="caseview-faixa-linha-superior" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 caseview-faixa-linha-superior-content-container">
											<!-- <?php if( $cats ) { ?><span class="tag"><?php echo $cats_html; ?></span><?php } ?> -->
											<?php if( $temp_cases_id ) { ?><a href="<?php echo get_page_link($temp_cases_id); ?>" class="ms-auto">VOLTAR PARA CASES<img src="<?php echo get_template_directory_uri(); ?>/images/icos/bigger.png" class="ms-3"></a><?php } ?>
									</div>
							</div>
					</div>
			</div>


			<div id="caseview-faixa-titulo" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 caseview-faixa-titulo-content-container text-georgiabold">
											<h3><b><?php echo $title; ?></b></h3>
									</div>
							</div>
					</div>
			</div>


			<div id="caseview-faixa-content" class="mt-3">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 caseview-faixa-content-content-container">
										<?php the_content(); ?>
									</div>
							</div>
					</div>
			</div>


			<?php if( $text = get_field('cs_ft_text') ) { ?>
			<div id="caseview-faixa-ficha-tecnica" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<!-- <div class="col-12 caseview-faixa-ficha-tecnica-title-container">
											<span class="detalhe">Case</span> 
									</div> -->
							</div>
							<div class="row">
									<div class="col-12 caseview-faixa-ficha-tecnica-content-container">
										<?php echo $text; ?>
									</div>
							</div>
					</div>
			</div>
			<?php } ?>


			<?php if( $query->have_posts() ) { ?>
			<div id="caseview-faixa-cases-relacionados" class="mt-5">
					<div class="container-xl">
							<div class="row">
									<div class="col-12">
											<span class="titulo-area">Cases Relacionados</span>
									</div>
							</div>
							<div class="row">
								<?php
								while( $query->have_posts() ) : $query->the_post();

									// image
									$img_src				 	= '';
									$img              = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '356x200' );
									if( $img )				{ $img_src = $img[0]; }

									// tags
									$tags_html				= '';
									$tags 						= get_the_terms( $post->ID, 'case-tag' );
									if( $tags ) {
										foreach( $tags as $tag ) :
											$tags_html	.= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>, ';
										endforeach;
										$tags_html		= rtrim( $tags_html, ', ' );
									}

								?>
									<div class="col-12 col-sm-4">
											<div class="card-case">
													<a href="<?php the_permalink(); ?>">
														<div class="card-case-img-wrapper"><img src="<?php echo $img_src; ?>"></div>
													</a>
													<p class="card-case-titulo"><?php echo get_the_title(); ?></p>
													<?php if( $tags ) { ?><p class="card-case-tags"><?php echo $tags_html; ?></p><?php } ?>
											</div>
									</div>
								<?php endwhile; wp_reset_postdata(); ?>
									<!-- <div class="col-12 col-sm-4">
											<div class="card-case">
													<a href="caseview.php">
															<div class="card-case-img-wrapper">
																	<img src="https://via.placeholder.com/1920x1080?text=16 x 9 photo">
															</div>
													</a>
													<p class="card-case-titulo">Lorem ipsum dolor sit amet.</p>
													<p class="card-case-tags"><a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
											</div>
									</div>
									<div class="col-12 col-sm-4">
											<div class="card-case">
													<a href="caseview.php">
															<div class="card-case-img-wrapper">
																	<img src="https://via.placeholder.com/1920x1080?text=16 x 9 photo">
															</div>
													</a>
													<p class="card-case-titulo">Lorem ipsum dolor sit amet.</p>
													<p class="card-case-tags"><a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
											</div>
									</div> -->
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



	</main>
<?php
get_footer();
