<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package brainbox
 */

get_header();
?>

	<main id="primary" class="site-main">


		<div id="blog-faixa-filtro">
				<div class="container-xl">
						<div class="row mt-5 border-bottom border-cinza2">
								<div class="col-6 col-md-8">
									<span class="titulo-area">Busca</span>
								</div>
								<div class="col-6 col-md-4 ">
									<form action="<?php echo site_url(); ?>" class="d-flex flex-grow-1 justify-content-end" method="get">
											<input id="blog-faixa-filtro-input-search" type="text" name="s" value="<?php echo $_GET['s']; ?>" class="d-inline-block" />
											<input type="hidden" name="post_type" value="post" />
											<button type="submit" id="blog-faixa-filtro-btn-lupa" class="ms-2 bg-transparent border-0"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/ico-search.png"></button>
									</form>
								</div>
						</div>
				</div>
		</div>


		<?php if ( have_posts() ) : ?>


			<?php
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


		<?php else : ?>
			<!-- SEM RESULTADO -->
		<?php endif; ?>


		<?php get_template_part( 'template-parts/content', 'newsletter' ); ?>

	</main><!-- #main -->

<?php
get_footer();
