<?php
/* Template name: Contato */


get_header();
?>
	<main id="primary" class="site-main">


		<?php while ( have_posts() ) : the_post(); ?>


			<?php
			if( have_rows('md_ct_fxs') ) {
				while( have_rows('md_ct_fxs') ) : the_row();
				$class		= '';
				$img1			= get_template_directory_uri().'/images/icos/email-amarelo.png';
				$img2			= get_template_directory_uri().'/images/icos/phone-amarelo.png';
				if( get_sub_field('md_ct_fxs_yel') ) {
					$class 	= ' amarelo';
					$img1		= get_template_directory_uri().'/images/icos/email-white.png';
					$img2		= get_template_directory_uri().'/images/icos/phone-white.png';
				}
			?>
			<div class="contato-faixa-item<?php echo $class; ?>">
					<div class="container-xl">
							<div class="row">
									<div class="col-12 justify-content-center col-lg-5 justify-content-lg-start d-flex mt-2 text-center">
											<span class="titulo-area"><?php echo get_sub_field('md_ct_fxs_title'); ?></span>
									</div>
									<div class="col-12 justify-content-center col-lg-4 d-flex justify-content-lg-start ms-auto mt-2 align-items-center text-center">
											<?php if( $mail = get_sub_field('md_ct_fxs_mail') ) { ?>
											<img src="<?php echo $img1 ?>" class="me-3">
											<?php echo $mail; ?>
											<?php } ?>
									</div>
									<div class="col-12 justify-content-center col-lg-3 d-flex justify-content-lg-end mt-2 align-items-center text-center">
											<?php if( !get_sub_field('md_ct_fxs_linker') && get_sub_field('md_ct_fxs_tel') ) { ?>
											<img src="<?php echo $img2; ?>" class="me-3">
											<b><?php echo get_sub_field('md_ct_fxs_tel'); ?></b>
											<?php
											}
											else if( get_sub_field('md_ct_fxs_linker') && get_sub_field('md_ct_fxs_link') ) {
											?>
											<a href="<?php echo get_sub_field('md_ct_fxs_link'); ?>" target="_blank" class="link-abre-area"><?php echo get_sub_field('md_ct_fxs_linklabel'); ?></a>
											<?php } ?>
									</div>
							</div>
					</div>
			</div>
			<?php endwhile; } ?>


		<?php endwhile; ?>


		<?php //get_template_part( 'template-parts/content', 'block-campus' ); ?>

	</main>
<?php
get_footer();
