<?php
/* Template name: Sobre */


$title			= get_the_title();
if( get_field('md_so_title') )	{ $title = get_field('md_so_title'); }



get_header();
?>
	<main id="primary" class="site-main">


		<?php while ( have_posts() ) : the_post(); ?>


			<!-- faixa sobre nós -->
			<div id="sobre-faixa-superior">
					<div class="container-xl">
							<div class="row align-items-center">
									<div class="col-auto d-flex justify-content-center">
											<p class="text-34pt titulo-area"><?php echo $title; ?></p>
									</div>
									<div class="col px-5">
											<?php if( $text = get_field('md_so_text') ) { ?><p class="texto"><?php echo $text; ?></p><?php } ?>
									</div>
							</div>
					</div>
			</div>


			<!-- Liderança -->
			<?php if( have_rows('md_so_lids') ) { ?>
			<div id="sobre-faixa-lideranca" class="mt-5">
					<div class="container-xl">
							<?php if( $title = get_field('md_so_lid_title') ) { ?>
							<div class="row">
									<div class="col-12">
											<span class="text-34pt titulo-area"><?php echo $title; ?></span>
									</div>
							</div>
							<?php } ?>
							<div class="row mt-3">
								<?php
								while( have_rows('md_so_lids') ) : the_row();
									$img 		= get_sub_field('md_so_lids_img');
								?>
									<div class="col-12 col-sm-4 mt-2">
											<div class="card-lideranca">
													<?php if( $img ) { ?><img src="<?php echo $img['sizes']['550x550']; ?>" class="lideranca-img"><?php } ?>
													<div class="lideranca-nome"><?php echo get_sub_field('md_so_lids_name'); ?></div>
													<?php if( $cargo = get_sub_field('md_so_lids_cargo') ) { ?><div class="lideranca-cargo"><?php echo $cargo; ?></div><?php } ?>
													<?php if( $link = get_sub_field('md_so_lids_linkedin') ) { ?><div class="lideranca-links"><a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icos/linkedin.png"></a></div><?php } ?>
											</div>
									</div>
								<?php endwhile; ?>
							</div>
					</div>
			</div>
			<?php } ?>


			<!-- NOSSAS CONQUISTAS -->
			<?php if( have_rows('md_so_con') ) { ?>
			<div class="sobre-faixa-conquistas my-5">
					<div class="container-xl">
							<?php if( $title = get_field('md_so_con_title') ) { ?>
							<div class="row">
									<div class="col-12">
											<span class="text-34pt titulo-area"><?php echo $title; ?></span>
									</div>
							</div>
							<?php } ?>
							<div class="row mt-5">
									<div class="col-12 d-flex flex-wrap justify-content-around">
										<?php while( have_rows('md_so_con') ) : the_row(); $img = get_sub_field('md_so_con_img'); ?>
											<div class="img-wrapper">
													<img src="<?php echo $img['url']; ?>">
											</div>
										<?php endwhile; ?>
									</div>
							</div>
					</div>
			</div>
			<?php } ?>


		<?php endwhile; ?>


		<?php //get_template_part( 'template-parts/content', 'block-campus' ); ?>

	</main>
<?php
get_footer();
