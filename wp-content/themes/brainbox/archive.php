<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brainbox
 */



//the_archive_title( '<h1 class="page-title">', '</h1>' );
//the_archive_description( '<div class="archive-description">', '</div>' );


$obj				= get_queried_object();
$obj_type		= $obj->taxonomy;						// category - case-tag
$obj_name		= $obj->name;
//echo '<pre>';print_r($obj); exit();


get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>


			<?php
			// TAG DOS CASES
			if( $obj_type === 'case-tag' ) { ?>

				<div id="cases-faixa-filtro">
	          <div class="container-xl">
	              <div class="row mt-5 border-bottom border-cinza2">
									<div class="col-12">
										<a href="<?php echo home_url('/cases'); ?>" class="ms-auto back-cases" style="font-weight: bolder; color: var(--cinza4); text-decoration: none; margin-left: auto !important; box-sizing: border-box; float: right;">VOLTAR PARA OS CASES<img src="https://dev2.vivaomundodigital.com.br/brainbox/wp-content/themes/brainbox/images/icos/bigger.png" class="ms-3"></a>
										<span class="titulo-area"><?php echo $obj_name; ?></span>
										
									</div>
	              </div>
	          </div>
	      </div>

				<div id="cases-faixa-cases" class="mt-3" data-explay-filter-pesquisa="" data-explay-filter-tag="">
	          <div class="container-xl">
	              <div class="row justify-content-left">
										<?php
										while( have_posts() ) : the_post();

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
	                  <div class="col-12 col-sm-4 case-container">
	                      <div class="card-case">
	                          <a href="<?php the_permalink(); ?>">
	                              <div class="card-case-img-wrapper">
	                                  <img src="<?php echo $img_src; ?>">
	                              </div>
	                          </a>
	                          <span class="card-case-titulo"><?php the_title(); ?></span>
														<?php if( $tags ) { ?><p class="card-case-tags"><?php echo $tags_html; ?></p><?php } ?>
	                      </div>
	                  </div>
										<?php endwhile; wp_reset_postdata(); ?>
	              </div>
	          </div>
	      </div>

				<div class="faixa-noticias">
						<div class="container-xl">
							<div class="pagi"><?php wp_pagenavi(); ?></div>
						</div>
				</div>

			<?php
			}	// end TAG DOS CASES

			// REST
			else {

				$array				= array();
				$i						= 0;
				while ( have_posts() ) : the_post();

					// img
					$img              				= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '550x550' );
					if( $img )								{ $img = $img[0]; }

					// cats
					$cats											= '';
					$catss 										= get_the_category( $post->ID );
					foreach($catss as $c) 		{ $cats .= '<a href="'.get_category_link($c->term_id).'">'.$c->name.'</a>, '; }
					$cats											= rtrim($cats, ', ');

					// date
					$date											= get_the_date();

					// results
					$array[$i]['title']				= get_the_title();
					$array[$i]['exc']				  = get_the_excerpt();
					$array[$i]['url']				  = get_the_permalink();
					$array[$i]['img']				  = $img;
					$array[$i]['cats']				= $cats;
					$array[$i]['date']				= $date;

					$i++;

				endwhile;
			?>


			<div id="cases-faixa-filtro">
					<div class="container-xl">
							<div class="row mt-5 border-bottom border-cinza2">
								<div class="col-12">
									<span class="titulo-area"><?php echo $obj_name; ?></span>
								</div>
							</div>
					</div>
			</div>


			<div class="faixa-noticias">
					<div class="container-xl">
						<?php if( isset($array[0]) || isset($array[1]) || isset($array[2]) || isset($array[3]) ) { ?>
							<div class="row faixa-noticias-grupo-3-container mt-3">
									<!-- coluna esquerda uma noticia grande -->
									<?php if( isset($array[0]) ) { ?>
									<div class="col-12 col-lg-6">
											<div class="card-noticia not-grande">
													<a href="<?php echo $array[0]['url']; ?>">
															<div class="card-noticia-img-wrapper"><img src="<?php echo $array[0]['img']; ?>"></div>
													</a>
													<a href="<?php echo $array[0]['url']; ?>" class="noticia-titulo"><?php echo $array[0]['title']; ?></a>
													<div class="noticia-tag-data-container">
															<?php echo $array[0]['cats']; ?>
															<span class="data"><?php echo $array[0]['date']; ?></span>
													</div>
													<p class="noticia-texto"><?php echo $array[0]['exc']; ?></p>
											</div>
									</div>
									<?php } ?>
									<?php if( isset($array[1]) || isset($array[2]) || isset($array[3]) ) { ?>
									<!-- coluna direita 2 noticias medias 1 noticia pequena -->
									<div class="col-12 col-lg-6">
											<?php if( isset($array[1]) ) { ?>
											<div class="card-noticia not-media">
													<div class="esq">
															<a href="<?php echo $array[1]['url']; ?>">
																	<div class="card-noticia-img-wrapper"><img src="<?php echo $array[1]['img']; ?>"></div>
															</a>
													</div>
													<div class="dir">
															<a href="<?php echo $array[1]['url']; ?>" class="noticia-titulo"><?php echo $array[1]['title']; ?></a>
															<div class="noticia-tag-data-container">
																	<?php echo $array[1]['cats']; ?>
																	<span class="data"><?php echo $array[1]['date']; ?></span>
															</div>
													</div>
											</div>
											<?php } ?>
											<?php if( isset($array[2]) ) { ?>
											<div class="card-noticia not-media">
													<div class="esq">
															<a href="<?php echo $array[2]['url']; ?>">
																	<div class="card-noticia-img-wrapper"><img src="<?php echo $array[2]['img']; ?>"></div>
															</a>
													</div>
													<div class="dir">
															<a href="<?php echo $array[2]['url']; ?>" class="noticia-titulo"><?php echo $array[2]['title']; ?></a>
															<div class="noticia-tag-data-container">
																	<?php echo $array[2]['cats']; ?>
																	<span class="data"><?php echo $array[2]['date']; ?></span>
															</div>
													</div>
											</div>
											<?php } ?>
											<?php if( isset($array[3]) ) { ?>
											<div class="card-noticia not-pequena">
													<a class="noticia-titulo" href="<?php echo $array[3]['url']; ?>"><?php echo $array[3]['title']; ?></a>
													<div class="noticia-tag-data-container">
															<?php echo $array[3]['cats']; ?>
															<span class="data"><?php echo $array[3]['date']; ?></span>
													</div>
													<p class="noticia-texto"><?php echo $array[3]['exc']; ?></p>
											</div>
											<?php } ?>
									</div>
									<?php } ?>
							</div>
						<?php } ?>
						<?php if( isset($array[4]) || isset($array[5]) || isset($array[6]) || isset($array[7]) ) { ?>
							<div class="row faixa-noticias-grupo-3-container mt-3">
									<?php if( isset($array[4]) || isset($array[5]) || isset($array[6]) ) { ?>
									<!-- coluna esquerda 2 noticias medias 1 noticia pequena -->
									<div class="col-12 col-lg-6">
											<?php if( isset($array[4]) ) { ?>
											<div class="card-noticia not-media">
													<div class="esq">
															<a href="<?php echo $array[4]['url']; ?>">
																	<div class="card-noticia-img-wrapper"><img src="<?php echo $array[4]['img']; ?>"></div>
															</a>
													</div>
													<div class="dir">
															<a href="<?php echo $array[4]['url']; ?>" class="noticia-titulo"><?php echo $array[4]['title']; ?></a>
															<div class="noticia-tag-data-container">
																	<?php echo $array[4]['cats']; ?>
																	<span class="data"><?php echo $array[4]['date']; ?></span>
															</div>
													</div>
											</div>
											<?php } ?>
											<?php if( isset($array[5]) ) { ?>
											<div class="card-noticia not-media">
													<div class="esq">
															<a href="<?php echo $array[5]['url']; ?>">
																	<div class="card-noticia-img-wrapper"><img src="<?php echo $array[5]['img']; ?>"></div>
															</a>
													</div>
													<div class="dir">
															<a href="<?php echo $array[5]['url']; ?>" class="noticia-titulo"><?php echo $array[5]['title']; ?></a>
															<div class="noticia-tag-data-container">
																	<?php echo $array[5]['cats']; ?>
																	<span class="data"><?php echo $array[5]['date']; ?></span>
															</div>
													</div>
											</div>
											<?php } ?>
											<?php if( isset($array[6]) ) { ?>
											<div class="card-noticia not-pequena">
													<a class="noticia-titulo" href="<?php echo $array[6]['url']; ?>"><?php echo $array[6]['title']; ?></a>
													<div class="noticia-tag-data-container">
															<?php echo $array[6]['cats']; ?>
															<span class="data"><?php echo $array[6]['date']; ?></span>
													</div>
													<p class="noticia-texto"><?php echo $array[6]['exc']; ?></p>
											</div>
											<?php } ?>
									</div>
									<?php } ?>
									<!-- coluna direita uma noticia grande -->
									<?php if( isset($array[7]) ) { ?>
									<div class="col-12 col-lg-6">
											<div class="card-noticia not-grande">
													<a href="<?php echo $array[7]['url']; ?>">
															<div class="card-noticia-img-wrapper"><img src="<?php echo $array[7]['img']; ?>"></div>
													</a>
													<a href="<?php echo $array[7]['url']; ?>" class="noticia-titulo"><?php echo $array[7]['title']; ?></a>
													<div class="noticia-tag-data-container">
															<?php echo $array[7]['cats']; ?>
															<span class="data"><?php echo $array[7]['date']; ?></span>
													</div>
													<p class="noticia-texto"><?php echo $array[7]['exc']; ?></p>
											</div>
									</div>
									<?php } ?>
							</div>
						<?php } ?>
					</div>
			</div>



			<div class="faixa-noticias">
					<div class="container-xl">
						<div class="pagi"><?php wp_pagenavi(); ?></div>
					</div>
			</div>



			<?php } // end rest ?>


		<?php else : ?>
			<!-- Sem resultado -->
		<?php endif; ?>


		<?php get_template_part( 'template-parts/content', 'newsletter' ); ?>

	</main><!-- #main -->

<?php
get_footer();
