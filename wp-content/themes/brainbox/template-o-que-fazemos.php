<?php
/* Template name: O que Fazemos */


get_header();
?>
	<main id="primary" class="site-main">


		<?php while ( have_posts() ) : the_post(); ?>


			<div id="o-que-fazemos-faixa-superior">

                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-34pt titulo-area"><?php echo get_the_title(); ?></p>
                        </div>
                        <div class="col-12 texto">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
			</div>


			<?php if( have_rows('md_of_servs') ) { ?>
			<div class="o-que-fazemos-faixa-servico">
					<div class="container-xl">
							<div id="o-que-fazemos-faixa-servico-accordion" class="accordion-flush">
								<?php $i=0; while( have_rows('md_of_servs') ) : the_row(); ?>
									<div class="accordion-item">
											<div class="accordion-header py-5 d-flex justify-content-between">
													<span class="titulo-area w-75"><?php echo get_sub_field('md_of_servs_title'); ?></span>
													<button class="bg-transparent border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>"></button>
											</div>
											<div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#o-que-fazemos-faixa-servico-accordion">
													<div class="accordion-body">
														<?php echo get_sub_field('md_of_servs_text'); ?>
													</div>
											</div>
									</div>
								<?php $i++; endwhile; ?>
							</div>
					</div>
			</div>
			<?php } ?>


			<?php if( $title = get_field('md_of_bl_title') ) { ?>
			<div id="o-que-fazemos-faixa-desafio">
					<div class="container-xl">
							<div class="row text-center">
									<div class="col-12">
											<p class="o-que-fazemos-faixa-desafio-titulo"><?php echo $title; ?></p>
									</div>
									<?php
									if( get_field('md_of_bl_linkin') || get_field('md_of_bl_linkex') ) {
										$target	= '';
										$url		= get_field('md_of_bl_linkin');
										if( get_field('md_of_bl_linkex') )	{ $url 		= get_field('md_of_bl_linkex'); }
										if( get_field('md_of_bl_linknew') )	{ $target = ' target="_blank"'; }
									?>
									<div class="col-12">
											<a href="<?php echo $url; ?>"<?php echo $target; ?> class="btn btn-h-60 btn-amarelo"><?php echo get_field('md_of_bl_linklabel'); ?></a>
									</div>
									<?php } ?>
							</div>
					</div>
			</div>
			<?php } ?>




		<?php endwhile; ?>


		<?php //get_template_part( 'template-parts/content', 'block-campus' ); ?>

	</main>
<?php
get_footer();
